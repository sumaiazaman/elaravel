<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use  Brian2694\Toastr\Facades\Toastr;
use App\Slider;
use Carbon\Carbon;

class SliderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $sliders = Slider::all();
        return view('admin.slider.index',compact('sliders'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {

        return view('admin.slider.create');
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
            'title' => 'required',            
            'sub_title' => 'required',            
            'image' => 'required|mimes:jpeg,jpg,bmp,png',
            'publication_status' => 'required',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);

        if(isset($image)){
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug."-".$currentDate."-".uniqid().".".$image->getClientOriginalExtension();
            if (!file_exists('uploads/slider')) {
                mkdir('uploads/slider',0777,true);
            }
            $image->move('uploads/slider',$imagename);
        }
        else {
            $image = 'default.png';
        }
        

        $slider = new Slider();
        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imagename;
        $slider->publication_status = $request->publication_status;

        Toastr::success('Slider Added Successfully !', 'Success', ["positionClass" => "toast-top-right"]);
        $slider->save();
        return redirect()->route('slider.index');
    }

    public function inactive($id)
    {
        $slider = Slider::find($id);
        $slider->publication_status = 0;
        Toastr::success('Slider Inactive Successfully !', 'Success', ["positionClass" => "toast-top-right"]);
        $slider->save();
        return redirect()->route('slider.index');
    }

    public function active($id)
    {
        $slider = Slider::find($id);
        $slider->publication_status = 1;
        Toastr::success('Slider Active Successfully !', 'Success', ["positionClass" => "toast-top-right"]);
        $slider->save();
        return redirect()->route('slider.index');
    }  
    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {      
     $slider = Slider::find($id);
     return view('admin.slider.edit', compact('slider'));
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
       $this->validate($request, [
            'title' => 'required',
            'sub_title' => 'required',
            'image' => 'mimes:jpeg,jpg,bmp,png',
        ]);

        $image = $request->file('image');
        $slug = str_slug($request->title);
        $slider = Slider::find($id);
        if (isset($image)) {
            $currentDate = Carbon::now()->toDateString();
            $imagename = $slug .'-'. $currentDate .'-'.uniqid().'.'.$image->getClientOriginalExtension();
            if (!file_exists('uploads/slider')) {
                mkdir('uploads/slider', 0777, true);
            }
            unlink('uploads/slider/'.$slider->image);
            $image->move('uploads/slider', $imagename);
        }else{
            $imagename = $slider->image;
        }

        $slider->title = $request->title;
        $slider->sub_title = $request->sub_title;
        $slider->image = $imagename;
        $slider->save();
        Toastr::success('Slider Updated Successfully','Success',["positionClass" => "toast-top-right"]);
        return  redirect()->route('slider.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
       $slider = Slider::find($id);
       if (file_exists('uploads/slider/'.$slider->image)) {
        unlink('uploads/slider/'.$slider->image);
    }
    $slider->delete();
    Toastr::success('Slider Deleted Successfully !', 'Success', ["positionClass" => "toast-top-right"]);
    return redirect()->back();
}
}
