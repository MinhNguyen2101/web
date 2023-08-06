<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.2') }}" rel="stylesheet" />
    <title>Product</title>
</head>

<body>
    @include('user.layouts.header')
    <!-- ///// -->
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

        .aside-item .aside-title h2 {
            height: 40px;
            width: 100%;
            font-size: 24px;
            font-family: "Montserrat", sans-serif;
            line-height: 40px;
            margin: 0;
            text-transform: none;
            font-weight: 700;
            display: inline-block;
            padding: 0px;
            position: relative;
        }

        .left-content .aside-item .aside-content {
            padding-bottom: 20px;
        }

        .filter-item * {
            cursor: pointer;
            color: #7b8395;
            font-family: "Montserrat", sans-serif;
            font-size: 14px;
            font-weight: 400;
        }

        .filter-group ul {
            max-height: 235px;
            overflow-y: auto;
            padding: 0px;
            list-style: none outside;
        }

        .filter-item {
            margin: 0;
            cursor: pointer;
            line-height: 28px;
            min-width: 100%;
            float: left;
            padding: 0px;
        }

        label {
            display: inline-block;
            max-width: 100%;
            margin-bottom: 5px;
        }

        .collection .category-products .sortPagiBar {
            display: inline-block;
            padding: 0;
            margin-top: 0px;
            width: 100%;
            padding-bottom: 5px;
        }

        .collection .title-head {
            display: inherit;
            font-family: "Montserrat", sans-serif;
            font-size: 20px;
            font-weight: bold;
            text-transform: none;
            line-height: 30px;
            margin: 0;
        }

        .row {
            margin-right: -15px;
            margin-left: -15px;
        }

        .product_border {
            /* border: 1px solid #f4f4f4; */
            padding: 1px;
            display: block;
            float: left;
            width: 100%;
            margin-bottom: 30px;
        }

        .product-box-h {
            border: 1px solid #ff9897;
            position: relative;
            min-height: 420px !important;
            margin: 0;
            background: #fff;
            -webkit-transition: 0.3s;
            -moz-transition: 0.3s;
            -ms-transition: 0.3s;
            -o-transition: 0.3s;
            transition: 0.3s;
        }

        product-box-h .product-thumbnail {
            position: relative;
        }

        .product-box-h .product-thumbnail>a.display_flex {
            width: 100%;
            text-align: center;
            position: relative;
            display: -webkit-box;
            display: -webkit-flex;
            display: -ms-flexbox;
            display: flex;
            -webkit-box-align: center;
            -webkit-align-items: center;
            -ms-flex-align: center;
            align-items: center;
            -webkit-box-pack: center;
            -webkit-justify-content: center;
            -ms-flex-pack: center;
            justify-content: center;
            height: 258.49px;
        }

        a,
        .text-link {
            color: #000;
            text-decoration: none;
            background: transparent;
        }

        .product-box-h .product-thumbnail>a.display_flex img {
            max-height: 100%;
            width: auto !important;
            max-width: 100%;
            display: block;
        }

        /* .product_border:hover {
            border: 2px solid #ff9897;
            padding: 0px;
        } */

        .clearfix:before {
            display: table;
            content: " ";
        }

        .clearfix:after {
            content: "";
            display: table;
            clear: both;
        }

        .product-box-h {
            position: relative;
            min-height: 420px !important;
            margin: 0;
            background: #fff;
            -webkit-transition: 0.3s;
            -moz-transition: 0.3s;
            -ms-transition: 0.3s;
            -o-transition: 0.3s;
            transition: 0.3s;
        }

        element.style {}

        .product-box-h .sale-flash.sale {}

        .product-box-h .sale-flash {
            position: absolute;
            width: 40px;
            height: 40px;
            top: 0px;
            left: 10px;
            text-align: center;
            z-index: 9;
            background-size: contain;
            background-repeat: no-repeat;
        }

        .product-box-h .product-action {
            text-align: center;
            display: none;
            position: absolute;
            left: 0px;
            bottom: 0px;
            width: 100%;
            z-index: 999;
        }

        input {
            display: inline-block;
            width: auto;
        }

        .product-box-h .product-action .btn.btn-cart {
            padding: 0 14px;
            height: 45px;
            line-height: 45px;
            border-radius: 3px;
            color: #fff;
            background-color: #ff6564;
            margin-right: 2px;
            font-weight: bold;
        }

        .product-box-h .product-info {
            z-index: 10;
            position: relative;
            padding: 0 10px 0px 20px;
            float: left;
            width: 100%;
        }

        .product-box-h .product-info .product-name {
            font-size: 14px !important;
            line-height: 21px;
            margin: 20px 0 5px 0;
            font-weight: 400;
            height: auto;
            word-break: break-word;
            max-height: 40px;
            overflow: hidden;
        }

        .product-box-h .product-info .product-name a {
            color: #000;
            text-decoration: none;
        }

        .text2line {
            overflow: hidden;
            display: -webkit-box;
            -webkit-line-clamp: 1;
            -webkit-box-orient: vertical;
        }

        .product-box-h .product-info .bizweb-product-reviews-badge {
            padding: 7px 0;
        }

        .product-box-h .product-hide {
            margin-top: 2px;
        }

        .product-box-h .product-info .product-hide .price-box .special-price {
            display: inline-block;
            margin-right: 7px;
        }

        .product-box-h .product-info .product-price {
            color: #ff9897;
            font-size: 16px;
            display: block;
            font-weight: bold;
            font-family: "Montserrat", sans-serif;
            word-break: break-word;
        }

        .product-box-h .product-info .product-hide .price-box .old-price {
            display: inline-block;
        }

        .product-box-h .product-info .product-price-old {
            text-decoration: line-through;
            font-family: "Montserrat", sans-serif;
            font-size: 13px;
            font-weight: 400;
            margin: 0;
            display: inline-block;
            color: #888888;
        }

        .product-price-btn {
            height: 103px;
            margin-top: 17px;
            position: relative;
        }

        .product-price-btn p {
            display: inline-block;
            position: absolute;
            top: -13px;
            height: 50px;
            font-family: 'Trocchi', serif;
            margin: 0 0 0 38px;
            font-size: 28px;
            font-weight: lighter;
            color: #474747;
        }

        span {
            display: inline-block;
            height: 50px;
            font-family: 'Suranna', serif;
            font-size: 15px;
        }

        .product-price-btn button {
            float: right;
            display: inline-block;
            height: 50px;
            width: 176px;
            margin: 0 40px 0 16px;
            box-sizing: border-box;
            border: transparent;
            border-radius: 60px;
            font-family: 'Raleway', sans-serif;
            font-size: 14px;
            font-weight: 500;
            text-transform: uppercase;
            letter-spacing: 0.2em;
            color: #ffffff;
            background-color: #ff9897;
            cursor: pointer;
            outline: none;
        }

        .svg-icon.svg-icon-gray-500 {
            color: #a1a5b7;
            margin-top: 14px;
        }

        .product-price-btn button:hover {
            background-color: #79b0a1;
        }
    </style>
    <div>
        <!-- BREADCUM -->
        <div class="breadcrumb_nobackground margin-bottom-40">
            <section class="bread-crumb">
                <div class="container">
                    <div class="row">
                        <div class="col-xs-12 a-left">
                            <ul class="breadcrumb">
                                <li class="home">
                                    <a href=""><span>Trang chủ</span></a>
                                    <span class="mr_lr">&nbsp;<i class="fa fa-angle-right"></i>&nbsp;</span>
                                </li>
                                @if (empty($name_search))
                                    <li><strong><span> Tất cả sản phẩm</span></strong></li>
                                @else
                                    <li><strong><span> Kết quả cho tìm kiếm: {{ $name_search }}</span></strong></li>
                                @endif
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        <!-- END BREADCUM -->

        <div class="container">
            <div class="row">
                <div class="bg_collection">
                    {{-- <aside class="dqdt-sidebar sidebar left-content col-lg-3 col-lg-3-fix"> --}}
                    {{-- <aside class="aside-item sidebar-category collection-category dmsp">
                            <div class="aside-filter">
                                <aside class="aside-item filter-vendor">
                                    <div class="aside-title">
                                        <h2 class="title-head margin-top-0">
                                            <span>Thương hiệu</span>
                                        </h2>
                                    </div>
                                    <div class="aside-content filter-group">
                                        <ul> --}}
                    {{-- @if (count($suppliers) > 0)
                                                @foreach ($suppliers as $item)
                                                    <li class="filter-item filter-item--check-box filter-item--green ">
                                                        <span>
                                                            <label for="filter-aha">
                                                                <input type="checkbox" wire:model="selecSupplier"
                                                                    value="{{ $item->id }}">
                                                                <i class="fa"></i>
                                                                {{ $item->name }}
                                                            </label>
                                                        </span>
                                                    </li>
                                                @endforeach
                                            @endif --}}
                    {{-- </ul>
                                    </div>
                                </aside>
                            </div>
                        </aside> --}}
                    {{-- <aside class="aside-item filter-price">
                            <div class="aside-title">
                                <h2 class="title-head margin-top-0"><span>Khoảng giá</span></h2>
                            </div>
                            <div class="aside-content filter-group">
                                <ul>
                                    <li class="filter-item filter-item--check-box filter-item--green">
                                        <span>
                                            <label data-filter="100-000d" for="filter-duoi-100-000d">
                                                <input type="radio" name='sortByPrice' value="(<100000)"
                                                    wire:model='selectPrice'>
                                                <i class="fa"></i>
                                                Giá dưới 100.000đ
                                            </label>
                                        </span>
                                    </li>
                                    <li class="filter-item filter-item--check-box filter-item--green">
                                        <span>
                                            <label data-filter="200-000d" for="filter-100-000d-200-000d">
                                                <input type="radio" name='sortByPrice' value="(>=100000 AND <=200000)"
                                                    wire:model='selectPrice'>
                                                <i class="fa"></i>
                                                100.000đ - 200.000đ
                                            </label>
                                        </span>
                                    </li>
                                    <li class="filter-item filter-item--check-box filter-item--green">
                                        <span>
                                            <label data-filter="300-000d" for="filter-200-000d-300-000d">
                                                <input type="radio" name='sortByPrice' value="(>=200000 AND <=300000)"
                                                    wire:model='selectPrice'>
                                                <i class="fa"></i>
                                                200.000đ - 300.000đ
                                            </label>
                                        </span>
                                    </li>
                                    <li class="filter-item filter-item--check-box filter-item--green">
                                        <span>
                                            <label data-filter="500-000d" for="filter-300-000d-500-000d">
                                                <input type="radio" name='sortByPrice' value="(>=300000 AND <=500000)"
                                                    wire:model='selectPrice'>
                                                <i class="fa"></i>
                                                300.000đ - 500.000đ
                                            </label>
                                        </span>
                                    </li>
                                    <li class="filter-item filter-item--check-box filter-item--green">
                                        <span>
                                            <label data-filter="1-000-000d" for="filter-500-000d-1-000-000d">
                                                <input type="radio" name='sortByPrice'
                                                    value="(>=500000 AND <=1000000)" wire:model='selectPrice'>
                                                <i class="fa"></i>
                                                500.000đ - 1.000.000đ
                                            </label>
                                        </span>
                                    </li>
                                    <li class="filter-item filter-item--check-box filter-item--green">
                                        <span>
                                            <label data-filter="1-000-000d" for="filter-tren1-000-000d">
                                                <input type="radio" name='sortByPrice' value="(>1000000)"
                                                    wire:model='selectPrice'>
                                                <i class="fa"></i>
                                                Giá trên 1.000.000đ
                                            </label>
                                        </span>
                                    </li>
                                </ul>
                            </div>
                        </aside> --}}
                    {{-- </aside> --}}

                    <div class="main_container collection col-lg-12 col-lg-12-fix padding-col-left-0">
                        <div class="category-products products">
                            <div class="sortPagiBar">
                                <div class="row">
                                    <div class="col-xs-12 col-sm-6 col-md-4 col-lg-12 no-padding-right-992">
                                        <div class="box-heading relative" style="display: flex">
                                            @if (empty($name_search))
                                                <span>
                                                    <h1 class="title-head margin-top-0">Tất cả sản phẩm</h1>
                                                </span>
                                                <span style="margin-left:886px">
                                                    <div class="input-group mb-3">
                                                        {{-- <strong style="margin-right: 10px">
                                                                    <div style="margin-top: 7px">Sắp xếp</div>
                                                                </strong> --}}
                                                        <form action="{{ route('route-index') }}" method="post">
                                                            @csrf
                                                            <select class="custom-select" id="inputGroupSelect01"
                                                                class="form-control" style="width: 180px"
                                                                name="sort">
                                                                <option selected>Sắp xếp</option>
                                                                <option value="price_asc">Giá tăng dần</option>
                                                                <option value="price_desc">Giá giảm dần</option>
                                                                <option value="name_asc">Tên A-Z</option>
                                                                <option value="name_desc">Tên Z-A</option>
                                                            </select>
                                                            <button type="submit">Sap xep</button>
                                                        </form>
                                                    </div>
                                                </span>
                                            @else
                                                <h3 style="margin-top: 13px"> Kết quả cho tìm kiếm: {{ $name_search }}
                                                </h3>
                                                <span style="margin-left:820px">
                                                    <div class="input-group mb-3">
                                                        {{-- <strong style="margin-right: 10px">
                                                                    <div style="margin-top: 7px">Sắp xếp</div>
                                                                </strong> --}}
                                                        <form action="{{ route('search-product') }}" method="post">
                                                            @csrf
                                                            @if (!empty($name_search))
                                                                <input type="hidden" name="search"
                                                                    value="{{ $name_search }}">
                                                            @endif
                                                            <select class="custom-select" id="inputGroupSelect01"
                                                                class="form-control" style="width: 190px"
                                                                name="sort">
                                                                <option selected>Sắp xếp</option>
                                                                <option value="price_asc">Giá tăng dần</option>
                                                                <option value="price_desc">Giá giảm dần</option>
                                                                <option value="name_asc">Tên A-Z</option>
                                                                <option value="name_desc">Tên Z-A</option>
                                                            </select>
                                                            <button type="submit">Sap xep</button>
                                                        </form>
                                                    </div>
                                                </span>
                                            @endif
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                @foreach ($products as $item)
                                    <div class="col-xs-12 col-sm-3 col-md-3 col-lg-3">
                                        <div class="product_border">
                                            <div class="product-box-h">
                                                <div class="product-thumbnail">
                                                    <a class="height_name text2line"
                                                        href="{{ route('product.show', $item->id) }}">
                                                        <img class="lazyload loaded"
                                                            src="{{ asset('storage') }}/{{ $item->image }}"
                                                            style="width: 100%;height:254px;">
                                                    </a>
                                                    @if ($item->price_old)
                                                        <div class="sale-flash sale"
                                                            style=" background-image: url(//bizweb.dktcdn.net/100/336/334/themes/802154/assets/label_sale.png?1610010652943)">
                                                        </div>
                                                    @else
                                                        <div class="sale-flash sale"
                                                            style="background-image: url(https://upload.wikimedia.org/wikipedia/commons/8/89/HD_transparent_picture.png)">
                                                        </div>
                                                    @endif
                                                </div>
                                                <div class="product-info a-left">
                                                    <h3 class="product-name">
                                                        <a class="height_name text2line text-center"
                                                            href="{{ route('product.show', $item->id) }}">
                                                            <h3>{{ $item->name }}</h3>
                                                        </a>
                                                    </h3>
                                                    <div class="bizweb-product-reviews-badge" data-id="12975046">
                                                    </div>
                                                    <div class="product-hides text-center">
                                                        <div class="product-hide">
                                                            @if ($item->price_old)
                                                                <div class="price-box clearfix" style="">
                                                                    <div class="special-price">
                                                                        <span class="price product-price">

                                                                            {{ number_format($item->price_new) }}
                                                                        </span>
                                                                    </div>

                                                                    <div class="old-price">
                                                                        <span class="price product-price-old">
                                                                            @if ($item->price_old)
                                                                                {{ number_format($item->price_old) }}
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            @else
                                                                <div class="price-box clearfix"
                                                                    style="margin-top:-34px;height:134px">
                                                                    <div class="special-price">
                                                                        <span class="price product-price">

                                                                            {{ number_format($item->price_new) }}
                                                                        </span>
                                                                    </div>

                                                                    <div class="old-price">
                                                                        <span class="price product-price-old">
                                                                            @if ($item->price_old)
                                                                                {{ number_format($item->price_old) }}
                                                                            @endif
                                                                        </span>
                                                                    </div>
                                                                </div>
                                                            @endif
                                                        </div>
                                                        @if ($item->price_old)
                                                            @if (empty(Auth::user()->id))
                                                                <div class="product-price-btn" style="margin-top: 25px">
                                                                    <a class="button" data-id="{{ $item->id }}">
                                                                        <button type="" onclick="myFunction()"
                                                                            style="margin-top: -10px">buy
                                                                            now</button>
                                                                    </a>
                                                                </div>
                                                            @else
                                                                <div class="product-price-btn"
                                                                    style="margin-top: 25px">
                                                                    <form action="{{ route('add-to-card') }}"
                                                                        method="post">
                                                                        @csrf
                                                                        <input type="hidden"
                                                                            value="{{ Auth::user()->id }}"
                                                                            name="user_id">
                                                                        <input type="hidden"
                                                                            value="{{ $item->id }}"
                                                                            name="product_id">
                                                                        <input type="hidden"
                                                                            value="{{ $item->price_new }}"
                                                                            name="price">
                                                                        <button type="submit"
                                                                            style="margin-top: -10px">buy now</button>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        @else
                                                            @if (empty(Auth::user()->id))
                                                                <div class="product-price-btn"
                                                                    style="margin-top: -25px">
                                                                    <a class="button" data-id="{{ $item->id }}">
                                                                        <button type="" onclick="myFunction()"
                                                                            style="margin-top: -10px">buy
                                                                            now</button>
                                                                    </a>
                                                                </div>
                                                            @else
                                                                <div class="product-price-btn"
                                                                    style="margin-top: -25px">
                                                                    <form action="{{ route('add-to-card') }}"
                                                                        method="POST">
                                                                        @csrf
                                                                        <input type="hidden"
                                                                            value="{{ Auth::user()->id }}"
                                                                            name="user_id">
                                                                        <input type="hidden"
                                                                            value="{{ $item->id }}"
                                                                            name="product_id">
                                                                        <input type="hidden"
                                                                            value="{{ $item->price_new }}"
                                                                            name="price">
                                                                        <button type="submit"
                                                                            style="margin-top: -10px">buy now</button>
                                                                    </form>
                                                                </div>
                                                            @endif
                                                        @endif
                                                    </div>

                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            </div>
                            {{ $products->links() }}
                        </div>
                    </div>
                </div>
                <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
                <script>
                    function myFunction() {
                        Swal.fire({
                            title: "Thông báo",
                            text: "Bạn cần đăng nhập trước",
                            icon: 'warning',
                            confirmButtonColor: '#3085d6',
                            confirmButtonText: "OK"
                        });
                    }
                </script>
            </div>
        </div>
    </div>
    </div>

    @include('user.layouts.footer')

    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script>
        function myFunction() {
            Swal.fire({
                title: "Thông báo",
                text: "Bạn cần đăng nhập trước",
                icon: 'warning',
                confirmButtonColor: '#3085d6',
                confirmButtonText: "OK"
            });
        }
    </script>
</body>

</html>
