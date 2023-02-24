<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Đổi mật khẩu</title>
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
                <div class="block-account">
                    <h5 class="title-account">Trang tài khoản</h5>
                    <p>Xin chào, <span style="color:#ff9897;">{{ $profile->name }}</span>&nbsp;!</p>
                    <ul style="list-style: none">
                        <li>
                            <a disabled="disabled" class="title-info" href="{{ route('profile.index') }}">Thông tin tài
                                khoản</a>
                        </li>
                        <li>
                            <a class="title-info" href="{{ route('order-history') }}">Đơn hàng của bạn</a>
                        </li>
                        <li>
                            <a class="title-info active" href="javascript:void(0);">Đổi mật khẩu</a>
                        </li>
                        <li>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-sm fw-bold btn-primary mt-5" style="font-size: 15px">
                                    Logout
                                </button>
                            </form>
                           
                        </li>

                    </ul>
                </div>
            </div>
            <div class="col-xs-12 col-sm-12 col-lg-9 col-right-ac mb-7">
                <h1 class="title-head margin-top-0">Đổi mật khẩu</h1>
                <div class="form-signup name-account m992">
                    <form action="{{ route('change-pass') }}" method="POST" style="font-size: 15px">
                        @csrf
                        <div class="form-group">
                            <label for="" style="font-size: 15px">
                                Mật khẩu cũ
                            </label>
                            <input type="password" class="form-control" style="width: 500px ;font-size: 15px"
                                name="pass_old">
                            @error('pass_old')
                                <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" style="font-size: 15px">
                                Mật khẩu mới
                            </label>
                            <input type="password" class="form-control" style="width: 500px ;font-size: 15px"
                                name="pass_new">
                            @error('pass_new')
                                <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label for="" style="font-size: 15px">
                                Nhập lại mật khẩu
                            </label>
                            <input type="password" class="form-control" style="width: 500px font-size: 15px"
                                name="re_pass_new">
                            @error('re_pass_new')
                                <span class="text-danger" style="font-size: 12px">{{ $message }}</span>
                            @enderror
                        </div>
                        <button type="submit" class="btn btn-sm fw-bold btn-primary mt-5" style="font-size: 15px">
                            Đổi mật khẩu
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    @include('user.layouts.footer')
    <script>
        @if (Session::has('message'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.success("{{ session('message') }}");
        @endif

        @if (Session::has('error'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.error("{{ session('error') }}");
        @endif

        @if (Session::has('info'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.info("{{ session('info') }}");
        @endif

        @if (Session::has('warning'))
            toastr.options = {
                "closeButton": true,
                "progressBar": true
            }
            toastr.warning("{{ session('warning') }}");
        @endif
    </script>
</body>

</html>
