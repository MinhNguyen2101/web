<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //
    public function index()
    {
        $product_new = Product::orderBy('id', 'desc')->limit(3)->get();
        $product_sale = Product::limit(3)->where('price_old', '!=', null)->get();

        return view('user.homepage', compact('product_new', 'product_sale'));
    }
}
