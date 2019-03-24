<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Category;
use App\Product;

class CategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //view categories
        $categories = Category::all();

        return view('backend.category.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request, [
                'category_name' => 'required',
                'short_description' => 'required'
            ]);


        // $cat = $request->only(['category_name', 'short_description']);
        // $cat['slug'] = str_slug($request->category_name);

        // dd($cat['slug']);

        // $cat = Category::create([
        //     'category_name'     => $request->category_name,
        //     'slug'              => 'ssdfsd',
        //     'short_description' => $request->short_description
        //     ]);

        $category = new Category;
        $category->category_name     = $request->category_name;
        $category->slug              = str_slug($request->category_name);
        $category->short_description = $request->short_description;
        $category->save();

        return redirect()->route('categories.index')->with('successMsg','Category Successfully Saved');
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
        // $category = Category::find($id);
        // return view('backend.category.edit',compact('category'));
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
        // $this->validate($request,[
        //     'category_name'     => 'required',
        //     'short_description' => 'required'
        // ]);

        // $category = Category::find($id);
        // $category->category_name     = $request->category_name;
        // $category->slug              = str_slug($request->category_name);
        // $category->short_description = $request->short_description;
        // $category->save();
        
        // return redirect()->route('categories.index')->with('successMsg','Category Successfully Updated');
    }

    //GET UNCATEGORIZED CATEGORY ID
    public function getUncategorized()
    {
        $uncat = Category::where('category_name', 'uncategorized')->get();

        return $uncat[0]['id'];
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $cat_product = Product::where('category_id', $id)->get();
       
       $uncatId = $this->getUncategorized();

       foreach ($cat_product as $product) {
           Product::where('id', $product->id)->update(['category_id' => $uncatId ]);
    
       }

       Category::find($id)->delete();
       return redirect()->back()->with('successMsg','Category Successfully Delete');
    }
    //end category controller
}
