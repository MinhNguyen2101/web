<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class HomepageController extends Controller
{
    //
    public function index(Request $request)
    {
        $product_new = Product::orderBy('id', 'desc')->where('status',1)->limit(3)->get();
        $product_sale = Product::limit(3)->where('price_old', '!=', null)->where('status',1)->get();

        return view('user.homepage', compact('product_new', 'product_sale'));
    }

    public function searchProduct(Request $request)
    {
        $name_search = $request->search;
        $product = Product::query();
        if(!empty($request->sort)){
            if($request->sort == 'price_asc')
            {
                $product = $product->orderBy('price_new','asc');
            }
            else if($request->sort == 'price_desc'){
                $product = $product->orderBy('price_new','desc');
            }
            else if($request->sort == 'name_asc')
            {
                $product = $product->orderBy('name','asc');
            }
            else{
                $product = $product->orderBy('name','desc');
            }
        }
        $products = $product->where('name', 'like', '%' . $request->search . '%')->paginate(8);

        return view('user.product', compact('products','name_search'));
    }
}
