<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  Brian2694\Toastr\Facades\Toastr;
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
        $categories = Category::all();
        return view('admin.category.index',compact('categories'));
    }
   
    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

     return view('admin.category.create');
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

        $category = new Category();
        $category->name = $request->name;
        $category->description = $request->description;
        $category->publication_status = $request->publication_status;        
        Toastr::success('Category Added Successfully !', 'Success', ["positionClass" => "toast-top-right"]);
        $category->save();
        return redirect()->route('category.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function inactive($id)
    {
        $category = Category::find($id);
        $category->publication_status = 0;
        Toastr::success('Category Inactive Successfully !', 'Success', ["positionClass" => "toast-top-right"]);
        $category->save();
        return redirect()->route('category.index');
    }

    public function active($id)
    {
        $category = Category::find($id);
        $category->publication_status = 1;
        Toastr::success('Category Active Successfully !', 'Success', ["positionClass" => "toast-top-right"]);
        $category->save();
        return redirect()->route('category.index');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
       $category = Category::find($id);
       return view('admin.category.edit', compact('category'));
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

        $category = Category::find($id);
        $category->name = $request->name;
        $category->description = $request->description;       
        Toastr::success('Category Updated Successfully !', 'Success', ["positionClass" => "toast-top-right"]);
        $category->save();
        return redirect()->route('category.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       Category::find($id)->delete();
       return redirect()->back()->with('successMsg','Category Successfully Deleted');

   }
}
