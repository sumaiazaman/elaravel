<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  Brian2694\Toastr\Facades\Toastr;
use App\Brand;

class BrandController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $brands = Brand::all();
        return view('admin.brand.index',compact('brands'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

       return view('admin.brand.create');
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
         'name' => 'required',
         'publication_status' => 'required',
     ]);

        $brand = new Brand();
        $brand->name = $request->name;
        $brand->description = $request->description;
        $brand->publication_status = $request->publication_status;        
        Toastr::success('Brand Added Successfully !', 'Success', ["positionClass" => "toast-top-right"]);
        $brand->save();
        return redirect()->route('brand.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inactive($id)
    {
        $brand = Brand::find($id);
        $brand->publication_status = 0;
        Toastr::success('Brand Inactive Successfully !', 'Success', ["positionClass" => "toast-top-right"]);
        $brand->save();
        return redirect()->route('brand.index');
    }

    public function active($id)
    {
        $brand = Brand::find($id);
        $brand->publication_status = 1;
        Toastr::success('Brand Active Successfully !', 'Success', ["positionClass" => "toast-top-right"]);
        $brand->save();
        return redirect()->route('brand.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
     $brand = Brand::find($id);
     return view('admin.brand.edit', compact('brand'));
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
         'name' => 'required',
     ]);

        $brand = Brand::find($id);
        $brand->name = $request->name;
        $brand->description = $request->description;       
        Toastr::success('Brand Updated Successfully !', 'Success', ["positionClass" => "toast-top-right"]);
        $brand->save();
        return redirect()->route('brand.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
     Brand::find($id)->delete();
     return redirect()->back()->with('successMsg','Brand Successfully Deleted');

 }
}
