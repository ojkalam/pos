<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Contact;
use App\Product;
use App\Sell;
use App\SellProduct;
use App\User;
use App\DiscountOffer;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use Mail;
use Mpdf\Mpdf;
use App\Notifications\ProductOutOfStock;

class SellController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sells = Sell::leftJoin('contacts as c', 'c.id', '=', 'sells.contact_id')->select('c.name as c_name','c.contact_id as c_id','sells.*')->orderBy('sells.id','desc')->get();

        return view('backend.sell.index', compact('sells') );
    }

     //send invoice to customer
     public function sendInvoice(Request $request)
    {   
        $this->validate($request, [
                'sell_id'    => 'required',
                'email' => 'required|email'
            ]);

        $id              = $request->sell_id;
        $customer_email  = $request->email;

        $sells = Sell::leftJoin('contacts as c', 'c.id', '=', 'sells.contact_id')
            ->where('sells.id',$id)
            ->select('c.name as c_name','c.contact_id as c_id', 'c.city','c.country','c.phone','c.email','sells.*')
            ->get();

        $sell_products = DB::table('sell_products')
            ->leftJoin('products as p', 'p.id', '=', 'sell_products.product_id')
            ->where('sell_products.sell_id',$id)->select('sell_products.*', 'p.*')
            ->get();

        //sending mail to customer
        $data = [
            'sells' => $sells,    
            'sell_products' => $sell_products    
        ];
        
        //ini_set('max_execution_time', 600);

        // return view('backend.sell.invoice_email', compact('data')); 

        try{
        
        Mail::send('backend.sell.invoice_email', $data, function($message) use ($sells, $sell_products, $customer_email){
            
            $dt = new Carbon($sells[0]['sale_date']);

            $message->from(env('MAIL_USERNAME'), 'ojkalam.me');
            $message->to($customer_email);
            $message->subject("Invoice Report of"." | ".$dt->toFormattedDateString(). " | Point of Sale");
        });

        }catch(\Exception $e){
            return redirect()->route('sells.show', $id)->withErrors('Send failed! Please try again! '.$e->getMessage());
        }

        return redirect()->route('sells.show', $id)->with('successMsg','Invoice Mail has been sent!');
    }

    //send sms invoice
    public function sendSmsInvoice (Request $request)
    {

        $this->validate($request, [
                'phone' => 'required',
                'total_paid' => 'required',
                'due' => 'required',
                'invoice_id' => 'required'
            ]);
        $id  = $request->sell_id;


        $basic  = new \Nexmo\Client\Credentials\Basic('9dcb6b48', '5OmlbWTWxHKToBVT');
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => $request->phone,
            'from' => 'POS',
            'text' => 'Your InvoiceID:'.$request->invoice_id." Total paid:".$request->total_paid." Due:".$request->due
        ]);

        return redirect()->route('sells.show', $id)->with('successMsg','Invoice SMS has been sent!');

    }

    //pdf invoice generate
    //
    public function pdfInvoice($id)
    {

        $sells = Sell::leftJoin('contacts as c', 'c.id', '=', 'sells.contact_id')
            ->where('sells.id',$id)
            ->select('c.name as c_name','c.contact_id as c_id', 'c.city','c.country','c.phone','c.email','sells.*')
            ->get();

        $sell_products = DB::table('sell_products')
            ->leftJoin('products as p', 'p.id', '=', 'sell_products.product_id')
            ->where('sell_products.sell_id',$id)->select('sell_products.*', 'p.*')
            ->get();

        $mpdf = new Mpdf();

        $html = view('backend.sell.invoice_email', compact(['sells', 'sell_products']));

        // Write some HTML code:
        $mpdf->WriteHTML($html);

        // Output a PDF file directly to the browser
        return $mpdf->Output('INVOICE'.Carbon::now().".pdf", 'I');

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $customers = Contact::where('type','customer')->get();
        $products = Product::where('stock_quantity', '>', 0)->get();
        $discounts = DiscountOffer::all();
        // $products = Product::where('stock_quantity', '>', 0)->get();

        return view('backend.sell.create', compact(['customers','products','discounts']));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    //generate invoice id
    public function generateInvoiceId ($prefix)
    {
        $last_sell_id = Sell::orderBy('id','desc')->take(1)->get();
        $ref_count    =  $last_sell_id[0]['id'];

        $ref_digits =  str_pad($ref_count, 4, 0, STR_PAD_LEFT);

        $invoice_id = $prefix . $ref_digits;

        return $invoice_id;
    }
    //store sell info
    public function store(Request $request)
    {

        $this->validate($request, [
                'customer_name' => 'required',
                'product_id' => 'required',      
                'quantity'   => 'required',      
                'sale_date'  => 'required|date',      
                'paid'       => 'required|numeric',
                'pay_method' => 'required'

            ]);

        $dt = Carbon::now();
        $now = $dt->toDateString(); 

        if ($request->sale_date != $now) {
            return redirect()->route('sells.create')->withErrors('The date is not matched with current date');
        }

        $total_amount = 0;

        foreach ($request->product_id as $key => $pid) {

            $pd_info = Product::find($pid);

            if ($pd_info->stock_quantity < $request->quantity[$key]) {
                return redirect()->route('sells.create')->withErrors('Stock quantity is less than given quantity');
            }
            //send notification alert_quantity
            elseif (($pd_info->stock_quantity - $request->quantity[$key]) <= $pd_info->alert_quantity && ($pd_info->stock_quantity - $request->quantity[$key])>0 ) {
                // dd();
                // $outOfstock = $pd_info->stock_quantity - $request->quantity[$key];
                // dd($outOfstock);
                $prod_notify = ['content' => $pd_info->p_name." | SKU: ".$pd_info->sku." | Product quantity is below ".($pd_info->stock_quantity - $request->quantity[$key])." or equal" ];
                //.$outOfstock+1

                User::find(5)->notify(new ProductOutOfStock($prod_notify));
            
            }
            //if product stock is equal to 0 then out of stock
            elseif(($pd_info->stock_quantity - $request->quantity[$key]) == 0) {

                $outOfstock = $pd_info->stock_quantity - $request->quantity[$key];
                //dd($outOfstock);

                $prod_notify = ['content'=> $pd_info->p_name." | SKU: ".$pd_info->sku." | "." Product out of stock"];

                User::find(5)->notify(new ProductOutOfStock($prod_notify));
            }

            $total_amount = $total_amount + ($request->quantity[$key]*$pd_info->sell_price_inc_tax);
            //save new product quantity
            $pd_info->stock_quantity = ($pd_info->stock_quantity - $request->quantity[$key]);
            $pd_info->save();
        
        }
        //end foreach
        if ($request->paid > $total_amount) {
            return redirect()->route('sells.create')->withErrors('Paid amount is greater than Total actual amount!');
        }

        $due = $total_amount-$request->paid;

        $sell = new Sell;

        $sell->invoice_id = $this->generateInvoiceId('INV');
        $sell->contact_id = $request->customer_name;
        $sell->sale_date  = $request->sale_date;
        $sell->pay_method = $request->pay_method;

        $sell->total_amount = $total_amount;
        $sell->paid         = $request->paid;
        $sell->due          = $due;
        $sell->pay_status   = ($due<1) ? 1 : 0 ;

        if ($request->notes) {
           $sell->notes     = $request->notes;
        }
        
        $sell->save();

        // dd($sell);

        foreach ($request->product_id as $key => $pid) {

            $sell_prod             = new SellProduct;
            $sell_prod->sell_id    = $sell->id;
            $sell_prod->product_id = $pid;
            $sell_prod->quantity   = $request->quantity[$key];
            $sell_prod->save();
        
        }

        return redirect()->route('sells.create')->with('successMsg','Sale Processed Successfully');

    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        
        $sells = Sell::leftJoin('contacts as c', 'c.id', '=', 'sells.contact_id')->where('sells.id',$id)->select('c.name as c_name','c.contact_id as c_id', 'c.city','c.country','c.phone','c.email','sells.*')->get();

        $sell_products = DB::table('sell_products')->leftJoin('products as p', 'p.id', '=', 'sell_products.product_id')->where('sell_products.sell_id',$id)->select('sell_products.*', 'p.*')->get();

        // foreach ($sell_products as $sell) {
        //     echo $sell->quantity;
        // }

        return view('backend.sell.show', compact(['sells','sell_products']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $sell = Sell::find($id);

        $sell_pds = SellProduct::where('sell_id', $sell->id)->get();
        foreach ($sell_pds as $key => $sell_pd) {
            $delspd = SellProduct::find($sell_pd->id);
            $delspd->delete();
        }
        $sell->delete();

        return redirect()->route('sells.index')->with('successMsg','Sale deleted Successfully');

    }
}
