<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  Brian2694\Toastr\Facades\Toastr;
use Carbon\Carbon;
use App\Product;
use App\Brand;
use App\Category;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $products = Product::all();
        return view('admin.product.index',compact('products'));        
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
       return view('admin.product.create',compact('categories','brands'));
   }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name'=> 'required',
            'category_id' => 'required',            
            'brand_id' => 'required',
            'price'=> 'required',            
            'image' => 'required|mimes:jpeg,jpg,bmp,png',
            'size'=> 'required',
            'color'=> 'required',
            'publication_status' => 'required',
        ]);
        $image = $request->file('image');
        $slug = str_slug($request->name);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug."-".$currentDate."-".uniqid().'.'.$image->getClientOriginalExtension();
            if(!file_exists('uploads/product')){
                mkdir('uploads/product', 0777, true);
            }
            $image->move('uploads/product',$imagename);
        }else{
            $image = 'default.png';
        }
        $product = new Product;
        $product->name = $request->name;
        $product->category_id = $request->category_id;
        $product->brand_id = $request->brand_id;        
        $product->short_description = $request->short_description;
        $product->long_description = $request->long_description;
        $product->price = $request->price;
        $product->image = $imagename;
        $product->size = $request->size;
        $product->color = $request->color;
        $product->publication_status = $request->publication_status;

        Toastr::success('Product Added Successfully !', 'Success', ["positionClass" => "toast-top-right"]);
        $product->save();

        return redirect()->route('product.index');
    }

    public function inactive($id)
    {
        $product = Product::find($id);
        $product->publication_status = 0;
        Toastr::success('Product Inactive Successfully !', 'Success', ["positionClass" => "toast-top-right"]);
        $product->save();
        return redirect()->route('product.index');
    }

    public function active($id)
    {
        $product = Product::find($id);
        $product->publication_status = 1;
        Toastr::success('Product Active Successfully !', 'Success', ["positionClass" => "toast-top-right"]);
        $product->save();
        return redirect()->route('product.index');
    }  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $categories = Category::all();
       $brands = Brand::all();
       $product = Product::find($id);
       return view('admin.product.edit', compact('brands','categories','product'));
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
        'name'=> 'required',
        'category_id' => 'required',            
        'brand_id' => 'required',
        'price'=> 'required',
        'size'=> 'required',
        'color'=> 'required',
    ]);
     $product = Product::find($id);
     $image = $request->file('image');
     $slug = str_slug($request->name);
     if (isset($image)) {
        $currentDate =  Carbon::now()->toDateString();
        $imagename = $slug.'-'.$currentDate.'-'.uniqid().'.'.$image->getClientOriginalExtension();
        if (!file_exists('uploads/product')) {
            mkdir('uploads/product',0777,true);
        }
        unlink('uploads/product/'.$product->image);
        $image->move('uploads/product',$imagename);
    }else{
        $imagename = $product->image;
    }
    $product->name = $request->name;
    $product->category_id = $request->category_id;
    $product->brand_id = $request->brand_id;        
    $product->short_description = $request->short_description;
    $product->long_description = $request->long_description;
    $product->price = $request->price;
    $product->image = $imagename;
    $product->size = $request->size;
    $product->color = $request->color;

    Toastr::success('Product Updated Successfully !', 'Success', ["positionClass" => "toast-top-right"]);
    $product->save();

    return redirect()->route('product.index');

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
        if (file_exists('uploads/product/'.$product->image)) {
            unlink('uploads/product/'.$product->image);
        }
        $product->delete();
        Toastr::success('Product Deleted Successfully !', 'Success', ["positionClass" => "toast-top-right"]);
        return redirect()->back();
    }
}
