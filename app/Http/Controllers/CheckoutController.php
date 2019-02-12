<?php

namespace App\Http\Controllers;
use Auth;
use App\User;
use App\Shipping;
use Illuminate\Support\Facades\Hash;

use Illuminate\Http\Request;

class CheckoutController extends Controller
{
	public function check_login(){
		return view('pages.check_login');
	}

	public function customer_checkout(Request $request){
		$customer =  new Customer();
		$customer->customer_name = $request->customer_name;
		$customer->customer_email = $request->customer_email;
		$customer->password = $request->password;
		$customer->mobile_number = $request->mobile_number;

		$customer->save();
		return view('pages.checkout',compact('customer'));
	}
	public function checkout(){		
		return view('pages.checkout');
	}

	public function submit(Request $request)
	{
		$this->validate($request, [
			'email' => 'required|string',
			'password' => 'required',
		]);

            //login this admin
		if (Auth::guard('web')->attempt(['email' => $request->email, 'password' => $request->password], $request->remember)) {
                //ligin now
			return redirect()->intended(route('show.checkout'));
		}else{
			return redirect()->route('check.login');
		}
	}

	public function save_shipping_details(Request $request){
        $shipping = new Shipping();
        $shipping->email = $request->email;
        $shipping->name = $request->name;
        $shipping->address = $request->address;
        $shipping->phone = $request->phone;
        $shipping->city = $request->city;

        $shipping->save();
        return view('pages.payment',compact('shipping'));
	}
   public function payment(){
   	  
   }

}
