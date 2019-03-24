<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Purchase;
use App\Contact;
use App\Product;
use App\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
class PurchaseController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
         $purchases = Purchase::leftJoin('contacts as c', 'c.id', '=', 'purchases.contact_id')->leftJoin('products as p', 'p.id', '=', 'purchases.product_id')->select('c.name as c_name','c.contact_id as c_id','purchases.*', 'p.p_name')->orderBy('purchases.id','desc')->get();

        return view('backend.purchase.index', compact('purchases') );
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $suppliers = Contact::where('type','supplier')->get();
        $products = Product::all();

        return view('backend.purchase.create', compact(['suppliers','products']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {   
        // return request()->all();

        $this->validate($request, [
                'product_id'   => 'required',      
                'contact_id' => 'required',
                'purchase_date'  => 'required',      
                'purchase_quantity' => 'required|numeric',
                'total_amount' => 'required'

            ]);


        $purchase = new Purchase;

        $purchase->product_id = $request->product_id;
        $purchase->contact_id = $request->contact_id;
        $purchase->purchase_date  = $request->purchase_date;
        $purchase->purchase_quantity = $request->purchase_quantity;

        $pd = Product::find($request->product_id);
        $pd->stock_quantity = ($pd->stock_quantity+ $request->purchase_quantity);
        $pd->save();
        
        $purchase->total_amount = $request->total_amount;
  
        $purchase->save();

        return redirect()->route('purchases.index')->with('successMsg','Purchase saved Successfully');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
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
        $p = Purchase::find($id);
        $p->delete();
        return redirect()->route('purchases.index')->with('successMsg','Purchase deleted Successfully');

    }
}
