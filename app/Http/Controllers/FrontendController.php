<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Support\Facades\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class FrontendController extends Controller
{
    public function Index(){
        $product    = Product::limit(8)->get();
        return view('frontend.index',compact('product'));
    }
    public function AddToCart($id){
         // Remove a specific key from the session
        Session::forget('cart');
         // Clear all session data
         Session::flush();
        // dd($id);
        $data  = Product::find($id);
        $p_qty      = json_decode($data->p_qty);
        $p_price    = json_decode($data->p_price);
        $p_image    = json_decode($data->p_image);
        if (Auth::user()) {

        }else{
            // if(Session::has('cart')) {
            //     $c_data  = Session::get('cart');
            //     foreach($c_data as $qty_d){
            //         if($data->id==$qty_d['p_id']){
            //             $qty_d['p_qty'] = 2;
            //         }
            //     }
            // }
            // Add the product to the cart session
            Session::push('cart', ['p_id'=>$data->id,'p_name'=>$data->p_name,'p_qty'=>$p_qty[0],'p_price'=>$p_price[0],'p_image'=>$p_image[0]]);
            //  $request->session()->push('cart', $product);
            return view('frontend.cart');
        }
    }
}
