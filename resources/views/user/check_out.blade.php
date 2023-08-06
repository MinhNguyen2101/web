<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Check Out</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.2') }}" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

</head>

<body>
    @include('user.layouts.header')
    <h1 style="margin-top: 15px;margin-left:40%; color:#e91e63">Đặt hàng</h1>
    <form action="{{ route('order') }}" method="POST">
        @csrf
        <!-- begin::Header-->
        <div class="card" style="margin-top: 15px;">
            <div class="card-body px-0 pb-2 col-sm-4 col-xl-3" style="margin-left: 30%">

                <table class="table align-items-center mb-0" style="font-size: 15px">
                    <tbody style="font-size: 15px">
                        <tr>
                            <td>
                                <h4 class="mb-0 ">Họ và tên</h4>
                            </td>
                            <td>
                                <p class=" mb-0 " style="font-size: 15px">{{ auth()->user()->name }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4 class="mb-0 ">Email</h4>
                            </td>
                            <td>
                                <p class=" mb-0 " style="font-size: 15px">{{ auth()->user()->email }}</p>
                            </td>
                        </tr>
                        <tr>
                            <td>
                                <h4 class="mb-0 ">Ngày đặt hàng</h4>
                            </td>
                            <td>
                                <p class=" mb-0 " style="font-size: 15px">{{ date('d-m-Y', strtotime(now())) }}</p>
                            </td>
                        </tr>
                </table>

            </div>
            <div style="margin-top: 40px;display: flex;justify-content: space-around;margin-left:153px">
                <div>
                    <h3 class="mb-0 ">Địa chỉ giao hàng</h3>
                    <h5>266 Đội Cấn, phường Liễu Giai, Quận Ba Đình, Hà Nội</h5>
                </div>
                <div style="width: 320px">
                    <h3 class="mb-0 ">Địa chỉ nhận hàng</h3>
                    <input type="text" style="font-size: 15px;width: 100%" class="form-control" name="address">
                    @error('address')
                        <p style="font-size:13px; color:red ">{{ $message }}</p>
                    @enderror
                </div>
            </div>

            <div class="card" style="margin-top: 15px;">
                <div class="table-responsive">
                    <table class="table align-items-center mb-0" style="width: 70%;text-align: center;margin-left: 17%;font-size: 15px">
                        <thead>
                            <tr>
                                <th class="text-uppercase text-secondary  font-weight-bolder opacity-7">Producr
                                </th>

                                <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">
                                    Quantity</th>
                                <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">
                                    Price</th>
                                <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">
                                    Size</th>
                                <th class="text-center text-uppercase text-secondary  font-weight-bolder opacity-7">
                                    Total</th>
                                <th class="text-secondary opacity-7"></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $total = 0; ?>
                            @foreach ($productCarts as $order_detail)
                                <input type="hidden" value="{{ $order_detail->product_id }}" name="product_id[]">
                                <input type="hidden" value="{{ $order_detail->quantity }}" name="quantity[]">
                                <input type="hidden" value="{{ $order_detail->price }}" name="price[]">
                                <input type="hidden" value="{{ $order_detail->size }}" name="size">
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
                                        {{ $order_detail->quantity }}
                                    </td>
                                    <td class="justify-content-center text-center">
                                        {{ number_format($order_detail->price) }}
                                    </td>
                                    <td class="justify-content-center text-center">
                                        {{$order_detail->size }}
                                    </td>
                                    <td class="text-center">
                                        {{ number_format($order_detail->quantity * $order_detail->price) }}
                                    </td>
                                </tr>
                                <?php $total = $total + $order_detail->quantity * $order_detail->price; ?>
                                <input type="hidden" value="{{ $total }}" name="total_price">
                            @endforeach
                            <tr style="font-size: 17px">
                                <td>
                                    <button class="btn btn-primary" type="submit" style="font-size: 17px">Đặt
                                        hàng</button>
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
    </form>
    <!-- end::Wrapper-->

    @include('user.layouts.footer')
</body>

</html>
