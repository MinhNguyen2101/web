<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Models\CartProduct;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Province;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class ProfileController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $profile = User::find(auth()->user()->id);
        $category = Category::limit(3)->get();

        return view('user.profile', compact('profile','category'));
    }

    public function orderHistory()
    {
        $category = Category::limit(3)->get();
        $order_history = Order::where('user_id', auth()->user()->id)->get();
        $profile = User::find(auth()->user()->id);

        return view('user.order_history', compact('order_history', 'profile','category'));
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
        $category = Category::limit(3)->get();
        $order_details = OrderDetail::where('order_id', $id)->get();
        $order = Order::find($id);

        return view('user.order_detail', compact('order', 'order_details','category'));
    }
    public function showChangePass()
    {
        $profile = User::find(auth()->user()->id);
        $category = Category::limit(3)->get();
        return view('user.change_password', compact('profile','category'));
    }

    public function changePass(Request $request)
    {
        $request->validate([
            'pass_old' => 'required',
            'pass_new' => 'required',
            're_pass_new' => ['same:pass_new'],
        ]);
        $current_password = auth()->user()->password;
        if (Hash::check($request->pass_old, $current_password)) {
            $user_id = auth()->user()->id;
            $obj_user = User::find($user_id);
            $obj_user->password = Hash::make($request->pass_new);
            $obj_user->save();
            return redirect()->route('showChangePass')->with('message', 'Đổi mật khẩu thành công');
        } else {
            return redirect()->route('showChangePass')->with('error', 'Mật khẩu cũ không chính xác');
        }
    }

    public function checkout()
    {
        $productCarts = CartProduct::where('user_id', auth()->user()->id)->get();



        return view('user.check_out', compact('productCarts'));
    }

    public function loadQuan(Request $request)
    {
    }

    public function loadXa(Request $request)
    {
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
