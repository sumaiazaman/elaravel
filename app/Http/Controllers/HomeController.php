<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Category;
use App\Brand;
use App\Product;
use App\Slider;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
       // $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $categories = Category::where('publication_status',1)->get();
        $brands = Brand::where('publication_status',1)->get();
        $products = Product::where('publication_status',1)->get();
        $sliders = Slider::where('publication_status',1)->get();
       // dd($categories);
        return view('pages.home',compact('categories','brands','products','sliders'));
    }

    public function category_product($id){
      $categories = Category::where('publication_status',1)->get();
      $products = Category::find($id)->products()->where('publication_status',1)->get();
      $brands = Brand::where('publication_status',1)->get();
      $sliders = Slider::where('publication_status',1)->get();
      return view('pages.category_product',compact('categories','brands','sliders'))->withProducts($products);
  }

  public function brand_product($id){
      $categories = Category::where('publication_status',1)->get();
      $products = Brand::find($id)->products()->where('publication_status',1)->get();
      $brands = Brand::where('publication_status',1)->get();
      $sliders = Slider::where('publication_status',1)->get();
      return view('pages.brand_product',compact('categories','brands','sliders'))->withProducts($products);
  }
   public function brand_product_details($id){
      $categories = Category::where('publication_status',1)->get();
      $product = Product::find($id);
      $brands = Brand::where('publication_status',1)->get();
      $sliders = Slider::where('publication_status',1)->get();
      return view('pages.brand_product_details',compact('categories','brands','sliders'))->withProduct($product);
  }

  public function category_product_details($id){
      $categories = Category::where('publication_status',1)->get();
      $product = Product::find($id);
      $brands = Brand::where('publication_status',1)->get();
      $sliders = Slider::where('publication_status',1)->get();
      return view('pages.category_product_details',compact('categories','brands','sliders'))->withProduct($product);
  }


}
