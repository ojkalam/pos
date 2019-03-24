<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Carbon\Carbon;
use App\Product;
use App\Category;
use App\Brand;
use App\Tax;
use App\Http\Requests\ProductRequest;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //view Portfolios
        $products = Product::orderBy('id', 'desc')->get();

        return view('backend.product.index', compact('products'));
    }

    //get products
    //ajax request
    public function getProducts ()
    {
        if (request()->ajax()) {    
            $term = request()->input('term');

            $result = Product::where('p_name','like', "%".$term."%")->get();

            $as = [
                        
                    'color' => "red",
                    'value' => "#f00",
            
                    'color2' => "green",
                    'value2' => "#0f0",
                        

                    ];

            return json_encode($result);
        }
    }   

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $categories = Category::all();
        $brands = Brand::all();
        $taxes = Tax::all();

        return view('backend.product.create', compact('categories','brands','taxes'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        // $this->validate($request, [
             
        //     ]);

        $image = $request->file('p_image');
        $slug = str_slug($request->p_name);

        if (isset($image)) {

            $currentDate = Carbon::now()->toDateString();
            
            $image_name = $slug.'-'.$currentDate .uniqid(). '.' .$image->getClientOriginalExtension();
            
            if (!file_exists('uploads/product')) {
                mkdir('uploads/product', 0777, true);
            }

            $image->move('uploads/product', $image_name);

        }else{
            $image_name = 'default.png';
        }

        $product = new Product;
        $product->p_name                       = $request->p_name;
        $product->category_id                  = $request->category_id;
        
        if ($request->brand_id){
           $product->brand_id  = $request->brand_id;
        }
        if($request->tax_id)
            $product->tax_id                   = $request->tax_id;
        
        $all_product = Product::all();
        foreach ($all_product as $key => $product) {
            $getpd = Product::find($product->id);
            if ($getpd->sku == $request->sku) {
                return redirect()->route('products.index')->withErrors('SKU is already Exist! Pleade enter a new one');
            }
        }

        $product->sku                          = $request->sku;
        $product->stock_quantity               = $request->stock_quantity;

        if($request->alert_quantity)
            $product->alert_quantity           = $request->alert_quantity;

        $product->default_purchase_price       = $request->default_purchase_price;
        
        if($request->profit_percent)
            $product->profit_percent           = $request->profit_percent;
        
        $product->sell_price_inc_tax           = round($request->sell_price_inc_tax);
        
        if($request->description)
            $product->description              = $request->description;
       
        $product->p_image                      = $image_name;
        $product->save();

        return redirect()->route('products.index')->with('successMsg','Product Successfully Saved');
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
        $product = Product::find($id);

        $categories = Category::all();

        return view('backend.product.edit', compact(['product','categories']));
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
        $this->validate($request,[
            'p_name'                  => 'required',
            'category_id'             => 'required|integer',
            'sku'                     => 'required',
            'stock_quantity'          => 'required|integer',
            'default_purchase_price'  => 'required|integer',
            'sell_price_inc_tax'      => 'required',
            ]);
        $product = Product::find($id);
        $product->p_name                       = $request->p_name;
        $product->category_id                  = $request->category_id;
        

        $product->sku                          = $request->sku;
        $product->stock_quantity               = $request->stock_quantity;

        if($request->alert_quantity)
            $product->alert_quantity           = $request->alert_quantity;

        $product->default_purchase_price       = $request->default_purchase_price;
        
        if($request->profit_percent)
            $product->profit_percent           = $request->profit_percent;
        
        $product->sell_price_inc_tax           = round($request->sell_price_inc_tax);
        
        $product->save();

        return redirect()->route('products.index')->with('successMsg','Product Successfully Updated');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product = Product::find($id);

        if (file_exists('uploads/product/'.$product->p_image)) {

            unlink('uploads/product/'.$product->p_image);

        }

        $product->delete();

        return redirect()->back()->with('successMsg','Product Successfully Delete');
    }
}
