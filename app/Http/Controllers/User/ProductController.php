<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartProduct;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Session as FacadesSession;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //
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

        $products = $product->where('status',1)->paginate(12);
        return view('user.product', compact('products'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
        $product = Product::find($id);

        return view('user.product_detail', compact('product'));
    }

    public function cartProduct()
    {
        $productCart = CartProduct::where('user_id', auth()->user()->id)->get();


        return view('user.cart_product', compact('productCart'));
    }

    public function addToCard(Request $request)
    {
        if ($request->quantity) {
            $quantity = $request->quantity;
        } else {
            $quantity = 1;
        }
        $product_isset = CartProduct::where('product_id', $request->product_id)->where('user_id', auth()->user()->id)->first();
        if (!empty($product_isset)) {
            $quantity_old = $product_isset->quantity;
            $quantity_new = $quantity_old + $quantity;

            $product_isset->update([
                'quantity' =>  $quantity_new,
            ]);
        } else {
            $cart = CartProduct::create([
                'user_id' => $request->user_id,
                'product_id' => $request->product_id,
                'price' => $request->price,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->route('cartProduct')->with('message', 'Thêm sản phẩm vào giỏ hàng thành công');
    }

    public function updateQuantityCart(Request $request)
    {
        $product_isset = CartProduct::where('product_id', $request->product_id)->where('user_id', auth()->user()->id)->first();

        $cart = $product_isset->update([
            'quantity' => $request->quantity_new,
        ]);
        if ($cart) {
            return redirect()->route('cartProduct')->with('message', 'Update giỏ hàng thành công');
        }
    }

    public function deleteProduct(Request $request)
    {
        $cart_product = CartProduct::find($request->cart_id);

        $cart_product->delete();

        return redirect()->route('cartProduct')->with('message', 'Xóa sản phẩm khỏi giỏ hàng thành công');
    }

    public function orderCheckout(Request $request)
    {
        $request->validate([
            'address' => 'required',
        ]);

        #insert in to table orders
        $order_success = Order::create([
            'order_code' => rand(10, 10000000),
            'user_id' => auth()->user()->id,
            'total_price' => $request->total_price,
            'address' => $request->address,
            'status' => 1,
            'created_at' => now(),
            'updated_at' => now(),
            
        ]);


        $productCart = CartProduct::where('user_id', Auth::user()->id)->get();

        $last_order = Order::latest()->first();

        $order_id = $last_order->id;
        // dd($last_order->order_code);
        #insert into order_detail
        if ($order_success) {
            foreach ($productCart as $item) {
                $order_detail = new OrderDetail();
                $order_detail->order_id = $order_id;
                $order_detail->order_code = $last_order->order_code;
                $order_detail->quantity = $item->quantity;
                $order_detail->price = $item->product->price_new;
                $order_detail->product_id = $item->product_id;
                $order_detail->created_at = now();
                $order_detail->updated_at = now();
                $order_detail->save();
            }
            # delete product in Cart
            CartProduct::where('user_id', auth()->user()->id)->delete();
        }
        return redirect()->route('cartProduct')->with('message', 'Đặt hàng thành công');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
