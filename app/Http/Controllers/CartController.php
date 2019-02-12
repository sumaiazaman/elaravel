<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Product;
use App\Category;
use Cart;

class CartController extends Controller
{
    public function product_send_to_cart(Request $request){
       $quantity = $request->quantity;
       $id = $request->id;
       $product = Product::where('id',$id)->first(); 

       $data['qty'] = $quantity; 
       $data['id'] = $product->id; 
       $data['name'] = $product->name; 
       $data['price'] = $product->price;
       $data['options']['image'] = $product->image;

       Cart::add($data);
       
       return redirect()->route('show.cart');
    }

    public function show_cart(){
       $category = Category::where('publication_status', 1)->get();

       $manage_category = view('pages.cart')->with('category',$category);
              
       return view('pages.cart',compact('manage_category'));
    }

   public function delete_to_cart($rowId){
      Cart::update($rowId, 0);
      return redirect()->back();
    }

    public function update_cart(Request $request){
      $quantity = $request->quantity;
      $rowId = $request->rowId;
      Cart::update($rowId, $quantity);
      return redirect()->back();
    }
}
