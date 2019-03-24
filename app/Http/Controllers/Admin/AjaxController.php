<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Product;
use App\User;
use App\Contact;
use App\Sell;
use App\SellProduct;
use Carbon\Carbon;
use Mail;
use Mpdf\Mpdf;
//excel
use App\Exports\SalesExport;
use App\Exports\CustomerSalesExport;

use Maatwebsite\Excel\Facades\Excel;

class AjaxController extends Controller
{
    //

    public function productPrice()
    {
        $price = Product::where('id', request('product'))->first();

        return json_encode($price);
    }

    //purchae price
    public function productPurchasePrice()
    {
        $price = Product::where('id', request('product'))->first();

        return json_encode($price);
    }
    
    //generate sales report based on date
    //
    public function salesReportView ()
    {               
        return view('backend.report.index');
    }
    //generate report
    public function salesReport ()
    {
        if (request('start_date') > request('end_date')) {
            return redirect()->route('report.salesreport')->withErrors('From Date cannot be ahead of To Date');
        }
        $sells = Sell::leftJoin('contacts as c', 'c.id', '=', 'sells.contact_id')->select('c.name as c_name','c.contact_id as c_id','sells.*')->whereBetween('sells.created_at', [request('start_date'), request('end_date')])->orderBy('sells.id','desc')->get();

        return view('backend.report.index', compact('sells'));
    }

    //generate PDF
    public function generateSalesPdf ()
    {
        // return request('start_date');

        $sells = Sell::leftJoin('contacts as c', 'c.id', '=', 'sells.contact_id')->select('c.name as c_name','c.contact_id as c_id','sells.*')->whereBetween('sells.created_at', [request('start_date'), request('end_date')])->orderBy('sells.id','desc')->get();

        $mpdf = new Mpdf();
        $from = request('start_date');
        $to = request('end_date');
        $html = view('backend.report.salespdf', compact('sells','from','to'));
        // return $html;
        // Write some HTML code:
        $mpdf->WriteHTML($html);

        // I: Output a PDF file directly to the browser , D:download file, F:save file
        return $mpdf->Output('sales_report_'.uniqid().".pdf", 'D');

    }

    //generate Excel sheet
    //
    public function generateSalesExcel ()
    {
        return Excel::download(new SalesExport, "customersales_".uniqid().".xlsx");
    }
    //============================
        //Generate Customer sales report
    //============================
    public function customersalesReportView ()
    {   
        $customers = Contact::where('type', 'customer')->get();   
        return view('backend.report.customerindex',compact('customers'));
    }
    //generate report
    public function customersalesReport ()
    {
        $customers = Contact::where('type', 'customer')->get();   
        $customer_sale = Contact::find(request('cus_id'));

        $sells = Sell::leftJoin('contacts as c', 'c.id', '=', 'sells.contact_id')->select('c.name as c_name','c.contact_id as c_id','sells.*')->where('c.id', request('cus_id'))->orderBy('sells.id','desc')->get();

        return view('backend.report.customerindex', compact('sells','customers','customer_sale'));
    }

    //generate PDF
    public function customergenerateSalesPdf ()
    {
        // return request('start_date');

        $customer_sale = Contact::find(request('cus_id'));

        $sells = Sell::leftJoin('contacts as c', 'c.id', '=', 'sells.contact_id')->select('c.name as c_name','c.contact_id as c_id','sells.*')->where('c.id', request('cus_id'))->orderBy('sells.id','desc')->get();


        $mpdf = new Mpdf();
        $html = view('backend.report.customersalespdf', compact('sells','customer_sale'));
        // return $html;
        // Write some HTML code:
        $mpdf->WriteHTML($html);

        // I: Output a PDF file directly to the browser , D:download file, F:save file
        return $mpdf->Output('customer_sales_report_'.uniqid().".pdf", 'D');

    }

    //generate Excel sheet
    //
    public function customergenerateSalesExcel ()
    {
        return Excel::download(new CustomerSalesExport, "customer_sales_".uniqid().".xlsx");
    }

    //get customer data 
 //    public function getCustomer (Request $request)
 //    {
 //    	//$product = Product::where('name','like','%'.$key.'%')->orWhere('sku', 'like'.'%'.$key.'%')->get();

 //    	// return $product;
 //    	$key = $request->search;

 //    	return response()->json($key);
    	
 //    }

 //    public function searchUsers(Request $request)
	// {
	// 	$user = User::where('name', 'LIKE', '%'.$request->q.'%')->get();

	// 	$user = response()->json($user);
	// 	$customers = [];
	// 	return view('backend.sell.create', compact('user','customers'));
	// }

    public function getProducts(Request $request)
 
    {
     
        if($request->ajax())   
        {
         
            $output="";
             
            $products=Product::where('p_name','LIKE','%'.$request->search."%")->get();
             
            if($products)
         
            {
             
                foreach ($products as $key => $product) {
                 
                $output.='<tr>'.
                 
                '<td>'.$product->id.'</td>'.
                 
                '<td>'.$product->p_name.'</td>'.
                                  
                '<td>'.$product->price.'</td>'.
                 
                '</tr>';
                }

            }
          
            return Response($output);
         
        }
    }

    //end search

    //sms send using nexmo service
    public function sendSMS ()
    {
        $basic  = new \Nexmo\Client\Credentials\Basic('9dcb6b48', '5OmlbWTWxHKToBVT');
        $client = new \Nexmo\Client($basic);

        $message = $client->message()->send([
            'to' => '8801521450823',
            'from' => 'Nexmo',
            'text' => 'Hello from Nexmo'
        ]);

    }


}
