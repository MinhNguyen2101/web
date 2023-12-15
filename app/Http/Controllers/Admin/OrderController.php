<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderDetail;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Http\Response;
use Illuminate\Support\Facades\Session;
use DataTables;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $orders = Order::orderBy('id', 'desc')->where('status', 1)->paginate(8);

        return view('admin.order.index', compact('orders'));
    }

    public function orderProcess()
    {
        $orders = Order::orderBy('id', 'desc')->where('status', 2)->paginate(8);

        return view('admin.order.order_process', compact('orders'));
    }

    public function getDataForTableNew()
    {
        return DataTables::of(Order::where('status',1)->with('user')->get())
        ->addColumn('user', function ($order) {
            return $order->user->name;
            })
        ->addColumn('status', function ($order) {
            if($order->status == 1) {
                return "Đơn hàng mới ";
            }else if($order->status == 2) {
                return "Đơn hàng đang xử lý ";
            }else if($order->status == 3) {
                return "Giao hang thanh cong";
            }else  {
                return "Đơn hàng bị hủy";
            }
            })
        ->addColumn('update', function ($order) {
                // Tùy chỉnh để trả về dữ liệu tìm kiếm cho trường "update"
                return $order->updated_at->format('Y-m-d H:i:s');
            })
        ->make(true);

    }

    public function getDataForTableSuccess()
    {
        return DataTables::of(Order::where('status',3)->with('user')->get())
        ->addColumn('user', function ($order) {
            return $order->user->name;
            })
        ->addColumn('status', function ($order) {
            if($order->status == 1) {
                return "Đơn hàng mới ";
            }else if($order->status == 2) {
                return "Đơn hàng đang xử lý ";
            }else if($order->status == 3) {
                return "Giao hang thanh cong";
            }else  {
                return "Đơn hàng bị hủy";
            }
            })
            ->addColumn('update', function ($order) {
                // Tùy chỉnh để trả về dữ liệu tìm kiếm cho trường "update"
                return $order->updated_at->format('Y-m-d H:i:s');
            })
        ->make(true);

    }
    public function getDataForTableProcess()
    {
        return DataTables::of(Order::where('status',2)->with('user')->get())
        ->addColumn('user', function ($order) {
            return $order->user->name;
            })
        ->addColumn('status', function ($order) {
            if($order->status == 1) {
                return "Đơn hàng mới ";
            }else if($order->status == 2) {
                return "Đơn hàng đang xử lý ";
            }else if($order->status == 3) {
                return "Giao hang thanh cong";
            }else  {
                return "Đơn hàng bị hủy";
            }
            })
            ->addColumn('update', function ($order) {
                // Tùy chỉnh để trả về dữ liệu tìm kiếm cho trường "update"
                return $order->updated_at->format('Y-m-d H:i:s');
            })
        ->make(true);

    }
    public function getDataForTableCancel()
    {
        return DataTables::of(Order::where('status',4)->with('user')->get())
        ->addColumn('user', function ($order) {
            return $order->user->name;
            })
        ->addColumn('status', function ($order) {
            if($order->status == 1) {
                return "Đơn hàng mới ";
            }else if($order->status == 2) {
                return "Đơn hàng đang xử lý ";
            }else if($order->status == 3) {
                return "Giao hang thanh cong";
            }else  {
                return "Đơn hàng bị hủy";
            }
            })
            ->addColumn('update', function ($order) {
                // Tùy chỉnh để trả về dữ liệu tìm kiếm cho trường "update"
                return $order->updated_at->format('Y-m-d H:i:s');
            })
        ->make(true);

    }

    public function orderSuccess()
    {
        $orders = Order::orderBy('id', 'desc')->where('status', 3)->paginate(8);

        return view('admin.order.order_success', compact('orders'));
    }
    public function orderCancel()
    {
        $orders = Order::orderBy('id', 'desc')->where('status', 4)->paginate(8);

        return view('admin.order.order_cancel', compact('orders'));
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
        $order_details = OrderDetail::where('order_id', $id)->get();
        $order = Order::find($id);

        return view('admin.order.show', compact('order', 'order_details'));
    }

    public function changeStatus(Request $request)
    {
        $order = Order::find($request->order_id);
        $order->update([
            'status' => $request->status,
        ]);
        if($request->status == 4)
        {
            $orderDetail = OrderDetail::where('order_id',$request->order_id)->get();
            
            foreach($orderDetail as $item) {
                $product = Product::find($item->product_id);
                $product->quantity = $product->quantity + $item->quantity ; 
                $product->save();
            }

        }
        Session::flash('message', 'Đơn hàng đã được chuyển trạng thái');

        return json_encode(array(
            "statusCode" => Response::HTTP_UNPROCESSABLE_ENTITY,
            "message" => __('messages.updated_success')
        ), JSON_THROW_ON_ERROR);
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
