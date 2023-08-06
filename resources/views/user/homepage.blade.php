<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.2') }}" rel="stylesheet" />
    <title>HomePage</title>
</head>

<body>
    @include('user.layouts.header')
    <!-- /// -->

    <style>
        body {
            background-color: ##fff3f3;
        }

        h2 {
            color: #000;
            letter-spacing: .01em;
            font-family: "Montserrat", sans-serif;
            line-height: 1.4;
        }

        .heading_hotdeal {
            padding: 0px 0 30px;
            margin-top: 20px;
        }

        .heading_hotdeal h2 {
            text-align: center;
            text-transform: uppercase;
            font-weight: bold;
            font-size: 28px;
            margin: 0;
            padding: 0;
            position: relative;
            background: #fff;
            z-index: 9;
        }

        .heading_hotdeal h2 a {
            z-index: 1;
            position: relative;
            display: inline-block;
            padding: 10px 25px;
            background-color: #fff;
            border-radius: 0;
            color: #000;
        }

        .heading_hotdeal h2:before {
            content: "";
            width: 100%;
            height: 2px;
            position: absolute;
            z-index: 0;
            left: 0px;
            background: #ff9897;
            bottom: 29px;
        }

        /* CSS Banner Trai */
        .home_banner {
            border-radius: 6px;
            background: #fff;
            border: 8px solid #ff9897;
        }

        .home_banner .bg_img_module {
            width: 100%;
            height: 408px;
            display: block;
            position: relative;
            background-color: #fff;
            background-size: contain;
            background-repeat: no-repeat;
            background-position: bottom center;
        }

        .heading h2 {
            font-size: 30px;
            position: absolute;
            top: 70px;
            left: 0;
            right: 0;
            padding: 0 30px;
            line-height: 42px;
            font-weight: 700;
            text-align: center;
        }

        .btn.btn-shop-now,
        input.btn-shop-now[type="submit"] {
            padding: 0px;
            border-radius: 0;
            text-transform: uppercase;
            position: absolute;
            bottom: 70px;
            left: 28%;
            right: 28%;
            font-weight: bold;
            font-size: 13px;
        }

        a,
        .text-link {
            color: #000;
            text-decoration: none;
            background: transparent;
        }

        a:hover {
            color: #ff9897;
            text-decoration: none;
            cursor: pointer;
        }

        .btn.btn-primary,
        input.btn-primary[type="submit"] {
            padding: 0 25px;
            background: #ff9897;
            color: #fff;
            border-radius: 30px;
            font-size: 14px;
            font-family: "Montserrat", sans-serif;
            border: 1px solid transparent;
        }

        .btn.btn-primary:hover,
        input.btn-primary[type="submit"]:hover {
            background: #fff;
            color: #ff9897;
            border: 1px solid #ff9897;
        }

        /* End CSS Banner Trai */

        .title h3 {
            margin: 0;
            font-size: 16px;
            font-weight: 600;
            font-family: "Montserrat", sans-serif;
            padding-bottom: 5px;
            padding-top: 5px;
            color: #363636;
        }

        .summary p {
            margin: 0;
            margin-top: 12px;
            color: #707070;
            border-top: 1px solid #ebebeb;
            padding-top: 15px;
            font-size: 14px;
            font-family: "Montserrat", sans-serif;
        }

        /* Cart Product */
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
            border: 1px solid #f4f4f4;
            padding: 1px;
            display: block;
            float: left;
            width: 100%;
            margin-bottom: 30px;
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

        /* End Cart Product */
    </style>

    <div>
        <div class="banner">
            <!-- <img src="{{ asset('storage') }}/banner2.jpg" alt="" width="100%"> -->
            <img src="https://bizweb.dktcdn.net/100/336/334/themes/802154/assets/slider_1.jpg?1638756922886"
                alt="" style="width: 100%;">
        </div>
        {{-- <div class="heading_hotdeal">
                    <h2 class="title-head" title="Sản phẩm bán chạy">
                        <a href="san-pham-noi-bat">Sản phẩm bán chạy</a>
                </div> --}}
        {{-- <div class="" style="background-color: #fff3f3;padding: 15px;">
            <div class="container">
                <div class="col-lg-3 col-md-3 col-sm-4">
                    <div class="home_banner banner_img">
                        <div class="image bg_img_module heading lazyload"
                            data-src="//bizweb.dktcdn.net/100/336/334/themes/802154/assets/bg_module_2.png?1638756922886"
                            title="Sản phẩm mới" data-was-processed="true"
                            style="background-image: url(&quot;//bizweb.dktcdn.net/100/336/334/themes/802154/assets/bg_module_2.png?1638756922886&quot;);">
                            <h2 class="title-base" title="Sản phẩm mới">
                                <a href="san-pham-moi" class="headline">Sản phẩm bán chạy</a>
                            </h2>
                            <a href="san-pham-moi" class="btn btn-primary btn-shop-now">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div style="display: flex;">
                    @foreach ($product_hot as $item)
                        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                            <div class="product_border">
                                <div class="product-box-h" style="border: 2px solid #ff9897 ">
                                    <div class="product-thumbnail">
                                        <a class="height_name text2line"
                                            href="{{ route('product_user.show', $item->id) }}">
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
                                            <a class="height_name text2line"
                                                href="{{ route('product_user.show', $item->id) }}">
                                                {{ $item->name }}<a class="height_name text2line"
                                                    href="{{ route('product_user.show', $item->id) }}">
                                                </a>
                                        </h3>
                                        <div class="bizweb-product-reviews-badge" data-id="12975046">
                                        </div>
                                        <div class="product-hides">
                                            <div class="product-hide">
                                                @if ($item->price_old)
                                                    <div class="price-box clearfix" style="">
                                                        <div class="special-price">
                                                            <span class="price product-price">

                                                                {{ Currency::currency('VND')->format($item->price_new) }}
                                                            </span>
                                                        </div>

                                                        <div class="old-price">
                                                            <span class="price product-price-old">
                                                                @if ($item->price_old)
                                                                    {{ Currency::currency('VND')->format($item->price_old) }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="price-box clearfix"
                                                        style="margin-top:-34px;height:134px">
                                                        <div class="special-price">
                                                            <span class="price product-price">

                                                                {{ Currency::currency('VND')->format($item->price_new) }}
                                                            </span>
                                                        </div>

                                                        <div class="old-price">
                                                            <span class="price product-price-old">
                                                                @if ($item->price_old)
                                                                    {{ Currency::currency('VND')->format($item->price_old) }}
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
                                                            <button type="" onclick="myFunction()">buy
                                                                now</button>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="product-price-btn" style="margin-top: 25px">
                                                        <form action="{{ route('add-to-card') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" value="{{ Auth::user()->id }}"
                                                                name="user_id">
                                                            <input type="hidden" value="{{ $item->id }}"
                                                                name="product_id">
                                                            <button type="submit">buy now</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @else
                                                @if (empty(Auth::user()->id))
                                                    <div class="product-price-btn" style="margin-top: -25px">
                                                        <div class="product-price-btn" style="margin-top: -25px">
                                                            <a class="button" data-id="{{ $item->id }}">
                                                                <button type="" onclick="myFunction()">buy
                                                                    now</button>
                                                            </a>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="product-price-btn" style="margin-top: -25px">
                                                        <form action="{{ route('add-to-card') }}" method="POST">
                                                            @csrf
                                                            <input type="hidden" value="{{ Auth::user()->id }}"
                                                                name="user_id">
                                                            <input type="hidden" value="{{ $item->id }}"
                                                                name="product_id">
                                                            <button type="submit">buy now</button>
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
            </div>
        </div> --}}
        <!-- ------------------ -->
        <div class="" style="background-color: #fff3f3;padding: 15px;">
            <div class="container">
                <div class="col-lg-3 col-md-3 col-sm-4">
                    <div class="home_banner banner_img">
                        <div class="image bg_img_module heading lazyload"
                            data-src="//bizweb.dktcdn.net/100/336/334/themes/802154/asset " title="Sản phẩm mới"
                            data-was-processed="true"
                            style="background-image: url(&quot;//bizweb.dktcdn.net/100/336/334/themes/802154/assets/bg_module_2.png?1638756922886&quot;);">

                            <h2 class="title-base" title="Sản phẩm mới">
                                <a href="san-pham-moi" class="headline">Sản phẩm giảm giá</a>
                            </h2>
                            <a href="san-pham-moi" class="btn btn-primary btn-shop-now">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div style="display: flex;">
                    @foreach ($product_sale as $item)
                        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4"><a class="height_name text2line"
                                href="">
                                <div class="product_border">
                                    <div class="product-box-h" style="border: 2px solid #ff9897 ">
                                        <div class="product-thumbnail">
                                            <a class="height_name text2line" href="">
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
                                                <a class="height_name text2line" href="">
                                                    {{ $item->name }}
                                                </a>
                                            </h3>
                                            <div class="bizweb-product-reviews-badge" data-id="12975046">
                                            </div>
                                            <div class="product-hides">
                                                <div class="product-hide">
                                                    @if ($item->price_old)
                                                        <div class="price-box clearfix" style="">
                                                            <div class="special-price">
                                                                <span class="price product-price">

                                                                    {{ $item->price_new }}
                                                                </span>
                                                            </div>

                                                            <div class="old-price">
                                                                <span class="price product-price-old">
                                                                    @if ($item->price_old)
                                                                        {{ $item->price_old }}
                                                                    @endif
                                                                </span>
                                                            </div>
                                                        </div>
                                                    @else
                                                        <div class="price-box clearfix"
                                                            style="margin-top:-34px;height:134px">
                                                            <div class="special-price">
                                                                <span class="price product-price">

                                                                    {{ $item->price_new }}
                                                                </span>
                                                            </div>

                                                            <div class="old-price">
                                                                <span class="price product-price-old">
                                                                    @if ($item->price_old)
                                                                        {{ $item->price_old }}
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
                                                                <button type="" onclick="myFunction()">buy
                                                                    now</button>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="product-price-btn" style="margin-top: 25px">
                                                            <form action="{{route('add-to-card')}}" method="post">
                                                                @csrf
                                                                <input type="hidden" value="{{ Auth::user()->id }}"
                                                                    name="user_id">
                                                                <input type="hidden" value="{{ $item->id }}"
                                                                    name="product_id">
                                                                    <input type="hidden" value="{{ $item->price_new }}"
                                                                    name="price">
                                                                <button type="submit">buy now</button>
                                                            </form>
                                                        </div>
                                                    @endif
                                                @else
                                                    @if (empty(Auth::user()->id))
                                                        <div class="product-price-btn" style="margin-top: -25px">
                                                            <a class="button" data-id="{{ $item->id }}">
                                                                <button type="" onclick="myFunction()">buy
                                                                    now</button>
                                                            </a>
                                                        </div>
                                                    @else
                                                        <div class="product-price-btn" style="margin-top: -25px">
                                                            <form action="{{ route('add-to-card') }}" method="POST">
                                                                @csrf
                                                                <input type="hidden" value="{{ Auth::user()->id }}"
                                                                    name="user_id">
                                                                <input type="hidden" value="{{ $item->id }}"
                                                                    name="product_id">
                                                                <input type="hidden" value="{{ $item->price_new }}"
                                                                    name="price">
                                                                <button type="submit">buy now</button>
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
            </div>
        </div>
        <!-- ------------------------------ -->

        <div class="" style="background-color: #fff3f3;padding: 15px;">
            <div class="container">
                <div class="col-lg-3 col-md-3 col-sm-4">
                    <div class="home_banner banner_img">
                        <div class="image bg_img_module heading lazyload"
                            data-src="//bizweb.dktcdn.net/100/336/334/themes/802154/assets/bg_module_2.png?1638756922886"
                            title="Sản phẩm mới" data-was-processed="true"
                            style="background-image: url(&quot;//bizweb.dktcdn.net/100/336/334/themes/802154/assets/bg_module_2.png?1638756922886&quot;);">
                            <h2 class="title-base" title="Sản phẩm mới">
                                <a href="san-pham-moi" class="headline">Sản phẩm mới</a>
                            </h2>
                            <a href="san-pham-moi" class="btn btn-primary btn-shop-now">Xem thêm</a>
                        </div>
                    </div>
                </div>
                <div style="display: flex;">
                    @foreach ($product_new as $item)
                        <div class="col-xs-6 col-sm-4 col-md-4 col-lg-4">
                            <div class="product_border">
                                <div class="product-box-h" style="border: 2px solid #ff9897 ">
                                    <div class="product-thumbnail">
                                        <a class="height_name text2line" href="">
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
                                            <a class="height_name text2line" href="">
                                                {{ $item->name }}
                                            </a>
                                        </h3>
                                        <div class="bizweb-product-reviews-badge" data-id="12975046">
                                        </div>
                                        <div class="product-hides">
                                            <div class="product-hide">
                                                @if ($item->price_old)
                                                    <div class="price-box clearfix" style="">
                                                        <div class="special-price">
                                                            <span class="price product-price">

                                                                {{ $item->price_new }}
                                                            </span>
                                                        </div>

                                                        <div class="old-price">
                                                            <span class="price product-price-old">
                                                                @if ($item->price_old)
                                                                    {{ $item->price_old }}
                                                                @endif
                                                            </span>
                                                        </div>
                                                    </div>
                                                @else
                                                    <div class="price-box clearfix"
                                                        style="margin-top:-34px;height:134px">
                                                        <div class="special-price">
                                                            <span class="price product-price">

                                                                {{ $item->price_new }}
                                                            </span>
                                                        </div>

                                                        <div class="old-price">
                                                            <span class="price product-price-old">
                                                                @if ($item->price_old)
                                                                    {{ $item->price_old }}
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
                                                            <button type="" onclick="myFunction()">buy
                                                                now</button>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="product-price-btn" style="margin-top: 25px">
                                                        <form action="{{ route('add-to-card') }}" method="post">
                                                            @csrf
                                                            <input type="hidden" value="{{ Auth::user()->id }}"
                                                                name="user_id">
                                                            <input type="hidden" value="{{ $item->id }}"
                                                                name="product_id">
                                                            <button type="submit">buy now</button>
                                                        </form>
                                                    </div>
                                                @endif
                                            @else
                                                @if (empty(Auth::user()->id))
                                                    <div class="product-price-btn" style="margin-top: -25px">
                                                        <a class="button" data-id="{{ $item->id }}">
                                                            <button type="" onclick="myFunction()">buy
                                                                now</button>
                                                        </a>
                                                    </div>
                                                @else
                                                    <div class="product-price-btn" style="margin-top: -25px">
                                                        <form action="" method="POST">
                                                            @csrf
                                                            <input type="hidden" value="{{ Auth::user()->id }}"
                                                                name="user_id">
                                                            <input type="hidden" value="{{ $item->id }}"
                                                                name="product_id">
                                                            <button type="submit">buy now</button>
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
            </div>
        </div>

        <div class="">
            <div class="container">
                <div class="heading_hotdeal">
                    <h2 class="title-head" title="Sản phẩm bán chạy">
                        <a href="san-pham-noi-bat">Tin Tuc </a>
                </div>
                <div class="post" style="display: flex;justify-content: space-around;">
                    <div style="display: block;">
                        <div>
                            <img style="height: 240px; width: 320px;"
                                src="https://bizweb.dktcdn.net/thumb/large/100/336/334/articles/img-2275.jpg?v=1540267898967"
                                alt="">
                        </div>
                        <div class="title">
                            <h3>
                                <a href="">
                                    Ten bai viet
                                </a>
                            </h3>
                        </div>
                        <div class="summary">
                            <p>Day la summary</p>
                        </div>
                    </div>

                    <div style="display: block;">
                        <div>
                            <img style="height: 240px; width: 320px;"
                                src="https://bizweb.dktcdn.net/thumb/large/100/336/334/articles/img-2275.jpg?v=1540267898967"
                                alt="">
                        </div>
                        <div class="title">
                            <h3>
                                <a href="">
                                    Ten bai viet
                                </a>
                            </h3>
                        </div>
                        <div class="summary">
                            <p>Day la summary</p>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    {{-- @include('livewire.user.homepage') --}}
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
