<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class DashboardController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
;        //
        $date_from = $request->date_from ?? now()->subDays(7);
        $date_to =$request->date_to ?? now();

        $total_user = User::count();
        $total_order_new = Order::where('status', 1)->whereBetween('orders.created_at', [$date_from . ' 00:00:00', $date_to . ' 23:59:59'])->count();
        $total_order_process = Order::where('status', 2)->whereBetween('orders.created_at', [$date_from . ' 00:00:00', $date_to . ' 23:59:59'])->count();
        $total_order_success = Order::where('status', 3)->whereBetween('orders.created_at', [$date_from . ' 00:00:00', $date_to . ' 23:59:59'])->count();
        $total_order_cancel = Order::where('status', 4)->whereBetween('orders.created_at', [$date_from . ' 00:00:00', $date_to . ' 23:59:59'])->count();
        $total_product = Product::count();
        $total_money = Order::where('status', 3)->sum('total_price');
        $total_category = Category::count();

        $totalMoneyByTime = $results = DB::table('orders')
        ->select(DB::raw('DATE(orders.created_at) as order_date'), DB::raw('COUNT(orders.id) as total_orders'),DB::raw('SUM(orders.total_price) as total_price'),DB::raw('SUM(order_details.quantity) as total_quantity'),"orders.status as status_order")
        ->whereBetween('orders.created_at', [$date_from . ' 00:00:00', $date_to . ' 23:59:59'])
        ->leftJoin('order_details', 'orders.id', '=', 'order_details.order_id')
        ->groupBy('order_date',"orders.status")
        ->orderBy('order_date')
        ->get();


        $chart_date = [];
        $chart_money = [];

        foreach($totalMoneyByTime as $item) {
            $chart_date[]= ($item->order_date);
            $chart_money[] = $item->total_price;
        }

        $dataForChart = [
            'labels' => $chart_date,
            'data' =>$chart_money,
        ];
// dd($totalMoneyByTime);
        
        return view(
            'admin.dasboard',
            compact(
                'total_user',
                'total_order_new',
                'total_order_process',
                'total_order_success',
                'total_order_cancel',
                'total_product',
                'total_money',
                'total_category',
                'totalMoneyByTime',
                'dataForChart',
            )
        );
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
