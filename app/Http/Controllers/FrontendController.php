<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\Product;
use Illuminate\Http\Request;

class FrontendController extends Controller
{
    public function Index(){
        $product    = Product::limit(8)->get();
        return view('frontend.index',compact('product'));
    }
    public function AddToCart($id){
        dd($id);
    }
}
