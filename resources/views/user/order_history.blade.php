<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.3/jquery.min.js"></script>
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

    <style>
        .breadcrumb_nobackground {
            display: block;
            width: 100%;
            overflow: hidden;
            margin-bottom: 20px !important;
        }

        .breadcrumb_nobackground .bread-crumb {
            display: block;
            width: 100%;
            background: #fff;
        }

        .breadcrumb_nobackground .bread-crumb .breadcrumb {
            margin: 0;
            font-size: 14px;
            padding: 15px 0;
            border-radius: 0;
            text-align: left;
        }

        .breadcrumb li {
            display: inline;
        }

        .breadcrumb_nobackground .bread-crumb .breadcrumb li .mr_lr {
            color: #000;
        }

        .breadcrumb li .mr_lr {
            padding: 0px 3px;
            color: #fff;
        }

        .breadcrumb li a:hover,
        .breadcrumb li.active,
        .breadcrumb li strong {
            color: #ff9897;
            font-weight: 400;
            text-decoration: none;
        }


        .col-left-ac .block-account .title-account {
            font-size: 19px;
            font-weight: 400;
            color: #212B25;
            margin-top: 0;
            margin-bottom: 15px;
            text-transform: uppercase;
        }

        .col-left-ac .block-account p {
            font-weight: 700;
            font-size: 14px;
            line-height: 16px;
            margin-bottom: 28px;
            color: #212B25;
            position: relative;
        }

        .col-left-ac .block-account ul {
            padding: 0;
            margin: 0;
        }

        .col-left-ac .block-account ul .title-info.active {
            color: #ff9897;
        }

        .col-left-ac .block-account ul .title-info {
            font-weight: 400;
            font-size: 14px;
            color: #212B25;
            margin-bottom: 22px;
            display: block;
        }

        a,
        .text-link {
            color: #000;
            text-decoration: none;
            background: transparent;
        }

        .col-left-ac .block-account ul .title-info {
            font-weight: 400;
            font-size: 14px;
            color: #212B25;
            margin-bottom: 22px;
            display: block;
        }

        .table-responsive-block .table-cart thead th {
            border-bottom: 1px solid #dee2e6;
            background: #ff9897;
            color: #fff;
            padding: 5px;
        }
        td{
            vertical-align: middle!important;
        }
    </style>
    @include('user.layouts.header')
    <!-- BREADCUM -->
    <div class="breadcrumb_nobackground margin-bottom-40">
        <section class="bread-crumb">
            <div class="container">
                <div class="row">
                    <div class="col-xs-12 a-left">
                        <ul class="breadcrumb">
                            <li class="home">
                                <a href="{{ route('trang-chu') }}"><span>Trang chủ</span></a>
                                <span class="mr_lr">&nbsp;<i class="fa fa-angle-right"></i>&nbsp;</span>
                            </li>
                            <li><strong><span> Lịch sử đơn hàng</span></strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- END BREADCUM -->
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-3 col-left-ac mb-7">
                <div class="block-account">
                    <h5 class="title-account">Trang tài khoản</h5>
                    <p>Xin chào, <span style="color:#ff9897;">{{ $profile->name }}</span>&nbsp;!</p>
                    <ul style="list-style: none">
                        <li>
                            <a class="title-info" href="{{ route('profile.index') }}">Thông tin
                                tài
                                khoản</a>
                        </li>
                        <li>
                            <a disabled="disabled" class="title-info active" href="javascript:void(0);">Đơn hàng của
                                bạn</a>
                        </li>
                        <li>
                            <a class="title-info" href="{{ route('showChangePass') }}">Đổi mật khẩu</a>
                        </li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm fw-bold btn-primary mt-5"
                                    style="font-size: 15px">
                                    Logout
                                </button>
                            </form>
                        </li>

                    </ul>
                </div>
            </div>


            <div class="col-xs-12 col-sm-12 col-lg-9 col-right-ac">
                <h1 class="title-head margin-top-0">Đơn hàng của bạn</h1>
                <div class="col-xs-12 col-sm-12 col-lg-12 no-padding">
                    <div class="my-account">
                        <div class="dashboard">
                            <div class="recent-orders">
                                <div class="table-responsive-block tab-all" style="overflow-x:auto;">
                                    <table class="table table-cart table-order" id="my-orders-table">
                                        <thead class="thead-default">
                                            <tr>
                                                <th>Đơn hàng</th>
                                                <th>Ngày</th>
                                                <th>Địa chỉ</th>
                                                <th>Giá trị đơn hàng</th>
                                                <th>Trạng thái vận chuyển</th>
                                            </tr>
                                        </thead>
                                        <tbody style=" font-size: 15px">
                                            {{-- @if (count($order_history) > 0) --}}
                                            @foreach ($order_history as $item)
                                                <tr>
                                                    <td style=" vertical-align: middle">
                                                        <a href="{{ route('profile.show', $item->id) }}">
                                                            {{ $item->order_code }}
                                                        </a>
                                                    </td>
                                                    <td style=" vertical-align: middle">
                                                        {{ date('d-m-Y', strtotime($item->created_at)) }}
                                                    </td>
                                                    <td style=" vertical-align: middle">
                                                        {{ $item->address }}
                                                    </td>
                                                    <td style=" vertical-align: middle">
                                                        {{ number_format($item->total_price) }}
                                                    </td>
                                                    <td style=" vertical-align: middle">
                                                        @if ($item->status == 1)
                                                            Đơn hàng mới
                                                        @elseif($item->status == 2)
                                                            Đơn hàng đang được xử lý
                                                        @elseif($item->status == 3)
                                                            Đơn hàng đã được giao thành công
                                                        @elseif($item->status == 4)
                                                            Đơn hàng bị hủy
                                                        @endif
                                                    </td>
                                                    <td style=" vertical-align: middle">
                                                        @if ($item->status == 1)
                                                            <form id="logout-form" action="" method="POST">
                                                                @csrf
                                                                <input type="hidden" name="_token"
                                                                    value="33vDREtmh2WAlkMmU44qj5Zf78MBYdRstsKpXSiF">
                                                                <button type="button"
                                                                    class="btn btn-sm fw-bold btn-primary mt-5 btn-cancel"
                                                                    style="font-size: 15px"
                                                                    data-url="{{ route('admin.changeStatusOrder') }}"
                                                                    data-order_id="{{ $item->id }}"
                                                                    data-status="4">
                                                                    Hủy
                                                                </button>
                                                            </form>
                                                        @endif
                                                    </td>


                                                </tr>
                                            @endforeach
                                            {{-- @else
                                                <tr>
                                                    <td colspan="6">
                                                        <p>Không có đơn hàng nào.</p>
                                                    </td>
                                                </tr>
                                                @endif --}}
                                        </tbody>
                                    </table>
                                </div>
                                <div
                                    class="paginate-pages pull-right page-account text-right col-xs-12 col-sm-12 col-md-12 col-lg-12">
                                </div>
                            </div>
                        </div>

                    </div>

                </div>
            </div>
        </div>
    </div>

    @include('user.layouts.footer')

    <script>
        $(function() {
            $(document).on('click', '.btn-cancel', function() {
                var status = $(this).data('status');
                var order_id = $(this).data('order_id');
                let url = $(this).data('url');
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: `${url}`,
                    data: {
                        'status': status,
                        'order_id': order_id
                    },
                    success: function(data) {
                        window.location.reload();
                    }
                });
            })
        });
    </script>
</body>

</html>
