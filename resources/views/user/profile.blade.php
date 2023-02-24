<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Profile</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.2') }}" rel="stylesheet" />
    {{-- @include('layouts.partials.style') --}}
</head>

<body>
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
                            <li><strong><span> Trang thông tin</span></strong></li>
                        </ul>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <!-- END BREADCUM -->
    <div class="container">
        <div class="row">
            <div class="col-xs-12 col-sm-12 col-lg-3 col-left-ac">
                <div class="block-account" style="font-size: 15px">
                    <h5 class="title-account">Trang tài khoản</h5>
                    <p>Xin chào, <span style="color:#ff9897;">{{ $profile->fullname }}</span>&nbsp;!</p>
                    <ul style="list-style: none">
                        <li>
                            <a disabled="disabled" class="title-info active" href="javascript:void(0);">Thông tin tài
                                khoản</a>
                        </li>
                        <li>
                            <a class="title-info" href="{{ route('order-history') }}">Đơn hàng của bạn</a>
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
                <h1 class="title-head margin-top-0">Thông tin tài khoản</h1>
                <div class="form-signup name-account m992" style="font-size: 15px">
                    <p style="font-size: 15px"><strong>Họ tên:</strong> {{ $profile->name }}</p>
                    <p style="font-size: 15px"> <strong>Email:</strong> {{ $profile->email }}</p>
                    <p style="font-size: 15px"> <strong>Số điện thoại:</strong> {{ $profile->phone }}</p>


                </div>

            </div>
        </div>
    </div>

    @include('user.layouts.footer')
</body>

</html>
