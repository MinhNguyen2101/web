<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.2') }}" rel="stylesheet" />
    <title>Order History</title>
</head>

<body>
    <!DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Profile</title>
    </head>

    <body>
        @include('user.layouts.header')
        <div class="row " style="display: flex;justify-content: center;font-size: 15px">
            <div class="col-lg-6 row ">
                <div class="card" style="display: flex;justify-content: space-around">
                    <h3 style="color: red">Order Detail</h3>
                    <div class="card-body px-0 pb-2 col-sm-4 col-xl-3" style="margin-left: 70px">

                        <table class="table align-items-center mb-0" style="font-size: 15px">
                            <tbody style="font-size: 15px">
                                <tr>
                                    <td>
                                        <h4 class="mb-0 ">Order Code</h4>
                                    </td>
                                    <td>
                                        <p class=" mb-0 " style="font-size: 15px">{{ $order->order_code }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="mb-0 ">Name</h4>
                                    </td>
                                    <td>
                                        <p class=" mb-0 "  style="font-size: 15px">{{ $order->user->name }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="mb-0 "  style="font-size: 15px">Email</h4>
                                    </td>
                                    <td>
                                        <p class=" mb-0 "  style="font-size: 15px">{{ $order->user->email }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="mb-0 ">Address</h4>
                                    </td>
                                    <td>
                                        <p class=" mb-0 "  style="font-size: 15px">{{ $order->address }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="mb-0 ">Status</h4>
                                    </td>
                                    <td>
                                        <p class="mb-0 "  style="font-size: 15px">{{ $order->status }}</p>
                                    </td>
                                </tr>
                                <tr>
                                    <td>
                                        <h4 class="mb-0 ">Date Order</h4>
                                    </td>
                                    <td>
                                        <p class="mb-0 "  style="font-size: 15px">{{ $order->created_at }}</p>
                                    </td>
                                </tr>
                        </table>
                    </div>
                </div>
            </div>

            <div class="card" style="margin-top: 15px;">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" style="width: 70%;text-align: center;margin-left: 17%">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary  font-weight-bolder opacity-7">Producr
                                </th>
                                <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">
                                    Size</th>
                                <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">
                                    Quantity</th>
                                <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">
                                    Price</th>
                                <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">
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
                                                <h4 class="mb-0">{{ $order_detail->product->name }}</h4>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="justify-content-center text-center">
                                        {{ $order_detail->size }}
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
                                <td>
                                    <h3> <a href="{{route('order-history')}}"> Back </a></h3>
                                </td>
                                <td colspan="3" class="text-end" style="color: red">
                                    Total:
                                </td>
                                <td class="text-end" style="color: red">
                                    {{ number_format($total) }} đ
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        @include('user.layouts.footer')
    </body>

    </html>
