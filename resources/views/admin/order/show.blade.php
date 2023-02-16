@extends('admin.layouts.app')
@section('contents')
    <div class="row " style="display: flex;justify-content: center">
        <div class="col-lg-6 row ">
            <div class="card" style="display: flex;justify-content: space-around">
                <h3 style="color: red">Order Detail</h3>
                <div class="card-body px-0 pb-2 col-sm-4 col-xl-3" style="margin-left: 70px">

                    <table class="table align-items-center mb-0">
                        <tbody>
                            <tr>
                                <td>
                                    <h6 class="mb-0 ">Order Code</h6>
                                </td>
                                <td>
                                    <p class="text-sm mb-0 ">{{ $order->order_code }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="mb-0 ">Name</h6>
                                </td>
                                <td>
                                    <p class="text-sm mb-0 ">{{ $order->user->name }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="mb-0 ">Email</h6>
                                </td>
                                <td>
                                    <p class="text-sm mb-0 ">{{ $order->user->email }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="mb-0 ">Address</h6>
                                </td>
                                <td>
                                    <p class="text-sm mb-0 ">{{ $order->address }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="mb-0 ">Status</h6>
                                </td>
                                <td>
                                    <p class="text-sm mb-0 ">{{ $order->status }}</p>
                                </td>
                            </tr>
                            <tr>
                                <td>
                                    <h6 class="mb-0 ">Date Order</h6>
                                </td>
                                <td>
                                    <p class="text-sm mb-0 ">{{ $order->created_at }}</p>
                                </td>
                            </tr>
                    </table>
                </div>
            </div>
        </div>

        <div class="card" style="margin-top: 15px">
            <div class="table-responsive">
                <table class="table align-items-center mb-0">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Producr</th>

                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Quantity</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Price</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Total</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $total = 0; ?>
                        @foreach ($order_details as $order_detail)
                            <tr>
                                <td>
                                    <div class="d-flex px-2 py-1">
                                        <div>
                                            <img src="{{ asset('storage/' . $order_detail->product->image) }}"
                                                style="width: 125px;height:auto">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-xs">{{ $order_detail->product->name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td class="justify-content-center text-center">
                                    {{ $order_detail->quantity }}
                                </td>
                                <td class="justify-content-center text-center">
                                    {{ number_format($order_detail->price) }}
                                </td>
                                <td class="text-center">
                                    {{ number_format($order_detail->quantity * $order_detail->price) }}
                                </td>
                            </tr>
                            <?php $total = $total + $order_detail->quantity * $order_detail->price; ?>
                        @endforeach
                        <tr>
                            <td colspan="4" class="text-end">
                                Total
                            </td>
                            <td class="text-end">
                                {{ number_format($total) }} đ
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
@endsection
