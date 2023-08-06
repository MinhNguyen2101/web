<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.2') }}" rel="stylesheet" />
    <title>Product</title>
    {{-- @include('layouts.partials.style') --}}
</head>

<body>
    @include('user.layouts.header')
    <!-- ///// -->
    <style>
        body {
            background: #fff
        }

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

        .title-product {
            color: #000;
            font-size: 30px;
            line-height: 36px;
            font-family: "Montserrat", sans-serif;
            margin: 0px;
            margin-bottom: 10px;
            font-weight: 400;
        }

        .details-pro .group-status {
            font-size: 14px;
            margin-bottom: 8px;
        }

        .details-pro .group-status .status_name {
            color: #ff9897;
        }

        .label_sl {
            font-weight: bold;
            display: inline-block;
            float: left;
            line-height: 45px;
            margin-right: 30px;
        }

        .margin-bottom-5 {
            margin-bottom: 5px !important;
        }

        .details-pro .price-box {
            margin: 8px 0 15px;
        }

        .details-pro .product-price {
            font-size: 34px;
            line-height: 30px;
            display: inline-block;
            color: #ff9897;
            font-weight: bold;
        }

        .details-pro .price-box del {
            color: #8d90a6;
            font-size: 14px;
            margin-left: 10px;
        }

        .button_actions {
            display: inline-block;
            float: left;
            margin-right: 25px;
        }

        .button_actions .btn_base {
            font-size: 14px;
            outline: none;
            box-shadow: none;
            text-transform: none;
            color: #fff;
            height: auto;
            line-height: inherit;
            width: 270px;
            height: 45px;
            line-height: 45px;
            border-radius: 30px;
            background: #ff9897;
            font-family: "Montserrat", sans-serif;
            border: 1px solid transparent;
        }

        .button_actions .btn_base .text_1 {
            font-size: 15px;
            font-weight: 700;
            line-height: 1.1;
            display: block;
            width: 100%;
            text-align: center;
        }

        .details-pro .product-summary {
            padding: 15px 0;
            border-bottom: 1px dashed #ff9897;
            border-top: 1px dashed #ff9897;
        }

        .details-pro .product-summary .rte {
            font-size: 14px;
            color: #000;
            line-height: 22px;
            font-family: "Montserrat", sans-serif;
        }

        .section_service_end {
            background-color: #fff;
            padding: 40px 0;
            overflow: hidden;
            margin-top: 50px;
            border-top: 1px solid #ebebeb;
            border-bottom: 1px solid #ebebeb;
        }

        .owl-carousel .owl-stage-outer {
            position: relative;
            overflow: hidden;
            -webkit-transform: translate3d(0, 0, 0);
        }

        .owl-carousel .owl-stage {
            position: relative;
            -ms-touch-action: pan-Y;
        }

        .owl-carousel.owl-drag .owl-item {
            -webkit-user-select: none;
            -moz-user-select: none;
            -ms-user-select: none;
            user-select: none;
        }

        .section_service_end .service_item_ed {
            height: 75px;
            padding: 0px 0px 0px 0px;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .section_service_end .service_item_ed .iconx {
            display: inline-block;
            width: 64px;
            height: 64px;
        }

        .section_service_end .service_item_ed .iconx img {
            max-width: 100%;
            height: auto;
        }

        .owl-carousel .owl-item img {
            width: auto;
        }

        .section_service_end .service_item_ed .content_srv {
            width: calc(100% - 96px);
            display: inline-block;
            float: left;
            margin-left: 25px;
        }

        .section_service_end .service_item_ed .content_srv .title_service {
            display: block;
            font-size: 18px;
            line-height: 24px;
            font-weight: 600;
            color: #000;
        }

        .section_service_end .service_item_ed .content_srv .content_service {
            display: block;
            font-size: 15px;
            font-weight: 400;
            line-height: 22px;
            margin-top: 5px;
            color: #898989;
        }

        .tab_h {
            float: left;
            width: 100%;
            margin-top: 30px;
        }

        .product-tab .tab-link.current {
            padding-bottom: 0px;
            border-bottom: 2px solid #ff9897;
        }

        ul.tabs li.current {
            color: #000;
            margin-bottom: -1px;
        }

        .product-tab .tab-link {
            position: relative;
            display: inline-block;
            background: transparent;
            padding: 0px;
            border-bottom: 0px;
            margin-top: 0px;
            margin-right: 40px;
        }

        .product-tab .tab-content.current .rte {
            color: #707070;
            border-top: none;
            padding: 45px 0px 60px 0px;
            font-size: 14px;
            font-family: "Montserrat", sans-serif;
        }

        .tab-content.current {
            opacity: 1;
            visibility: visible;
            height: auto;
            transition: all 200ms ease-in-out;
        }

        .product-tab .tab-content {
            padding: 0px;
        }

        .related-product {
            margin-top: 0px !important;
            display: block;
            float: left;
            width: 100%;
        }

        .related-product .heading {
            padding: 0px !important;
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
            height: 1px;
            position: absolute;
            z-index: 0;
            left: 0px;
            background: #ff9897;
            bottom: 29px;
        }

        /* style button size */
        .wrapper {
            display: inline-flex;
            background: #fff;
            align-items: center;
            justify-content: space-evenly;
            border-radius: 5px;
            padding: 20px 15px;
            box-shadow: 5px 5px 30px rgba(0, 0, 0, 0.2);
            margin-bottom: 25px
        }
    </style>
    <div style="margin-bottom: 25px">
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
                                <li>
                                    <strong>
                                        <a href="{{ route('product.index') }}">
                                            <span> Tất cả sản phẩm</span>
                                        </a>
                                    </strong>
                                </li>
                                <li>
                                    <strong>
                                        <span>{{ $product->name }}</span>
                                    </strong>
                                </li>
                            </ul>
                        </div>
                    </div>
                </div>
            </section>
        </div>
        {{-- Product detail --}}
        <div class="container">
            <div class="product-info" style="display: flex">
                {{-- Image Product --}}
                <div class="product-detail-left product-images col-xs-12 col-sm-6 col-md-6 col-lg-6">
                    <div class="col_large_default large-image">
                        <div style="height:553px;width:553px;" class="zoomWrapper">
                            <div style="height:553px;width:553px;" class="zoomWrapper">
                                <img class="checkurl img-responsive" id="img_01"
                                    src="{{ asset('storage') }}/{{ $product->image }}"
                                    style="position: absolute; width: 553px; height: 553px; border: 1px dashed #ff9897   ">
                            </div>
                        </div>
                    </div>
                </div>
                {{-- End Image Product --}}

                <div class="col-xs-12 col-sm-6 col-md-6 col-lg-6 details-pro ">
                    <h1 class="title-product">{{ $product->name }}</h1>

                    <div class="group-status">
                        <span class="first_status">Thương hiệu:
                            @if ($product->supplier_id)
                                <span class="status_name">
                                    {{ $product->supplier->name }}

                                </span>
                            @endif
                        </span>
                        <span class="first_status status_2">
                            <span class="line_tt hidden-sm">
                                |
                            </span>
                            Tình trạng:
                            @if ($product->quantity > 0)
                                <span class="status_name availabel">Còn hàng ({{ $product->quantity }} sản phẩm)</span>
                            @else
                                <span class="status_name availabel">Hết hàng</span>
                            @endif
                        </span>
                    </div>
                    <div class="price-box">
                        <!-- Giá Khuyến mại -->
                        <span class="special-price"><span class="price product-price">
                                {{ number_format($product->price_new) }}
                            </span>
                        </span>
                        @if ($product->price_old)
                            <span class="old-price">
                                <del class="price product-price-old sale" style="font-size: 25px">
                                    {{ number_format($product->price_old) }}
                                </del>
                            </span> <!-- Giá gốc -->
                        @endif
                    </div>


                    <div style="width: 100%">
                        <div class="button_actions clearfix">
                            @if (empty(Auth::user()->id))
                                {{-- <div class="wrapper">
                                    <input type="radio" name = "size" value="s" checked
                                        style="font-size: 25px;margin-top: unset;margin: 5px;">
                                    <label for="option-1" class="option option-1" style="font-size: 20px">
                                        <div class="dot"></div>
                                        <span>S</span>
                                    </label>
                                    <input type="radio" name = "size" value="M"
                                        style="font-size: 25px;margin-top: unset;margin: 5px;">
                                    <label for="option-2" class="option option-2" style="font-size: 20px">
                                        <div class="dot"></div>
                                        <span>M</span>
                                    </label>
                                    <input type="radio" name = "size" value="l"
                                        style="font-size: 25px;margin-top: unset;margin: 5px;">
                                    <label for="option-3" class="option option-3" style="font-size: 20px">
                                        <div class="dot"></div>
                                        <span>L</span>
                                    </label>
                                    <input type="radio" name = "size" value="xl"
                                        style="font-size: 25px;margin-top: unset;margin: 5px;">
                                    <label for="option-4" class="option option-4" style="font-size: 20px">
                                        <div class="dot"></div>
                                        <span>XL</span>
                                    </label>
                                </div> --}}
                                <div class="product-summary product_description margin-bottom-0">
                                    <div class="rte description ">

                                        Thông tin sản phẩm đang được cập nhật.

                                    </div>
                                </div>
                                <div class="label_sl margin-bottom-5"
                                    style="display: flex; justify-content: space-around;width: 100%;font-size: 15px">
                                    <span>Số lượng:</span>
                                    <input type="number" min="1" class="form-control"
                                        max="{{ $product->quantity }}"
                                        style="width: 50%; margin-top:6px;margin-left: 15px;font-size: 25px"
                                        name="quantity">
                                </div>
                                <div class="product-price-btn" style="margin-top: 25px">
                                    <a class="button">
                                        <button onclick="myFunction()"
                                            class="btn btn_base btn_add_cart btn-cart add_to_cart">
                                            <span class="text_1">
                                                Cho vào giỏ hàng
                                            </span>
                                        </button>
                                    </a>
                                </div>
                            @else
                                <form action="{{ route('add-to-card') }}" method="post">
                                    {{-- <div class="wrapper">
                                        <input type="radio" name="size" value="S" checked
                                            style="font-size: 25px;margin-top: unset;margin: 5px;">
                                        <label for="option-1" class="option option-1" style="font-size: 20px">
                                            <div class="dot"></div>
                                            <span>S</span>
                                        </label>
                                        <input type="radio" name="size" value="M"
                                            style="font-size: 25px;margin-top: unset;margin: 5px;">
                                        <label for="option-2" class="option option-2" style="font-size: 20px">
                                            <div class="dot"></div>
                                            <span>M</span>
                                        </label>
                                        <input type="radio" name = "size" value="L"
                                            style="font-size: 25px;margin-top: unset;margin: 5px;">
                                        <label for="option-3" class="option option-3" style="font-size: 20px">
                                            <div class="dot"></div>
                                            <span>L</span>
                                        </label>
                                        <input type="radio" name = "size" value="XL"
                                            style="font-size: 25px;margin-top: unset;margin: 5px;">
                                        <label for="option-4" class="option option-4" style="font-size: 20px">
                                            <div class="dot"></div>
                                            <span>XL</span>
                                        </label>
                                    </div> --}}
                                    <div class="product-summary product_description margin-bottom-0">
                                        <div class="rte description ">

                                            Thông tin sản phẩm đang được cập nhật.

                                        </div>
                                    </div>
                                    <div class="product-price-btn" style="margin-top: 25px">

                                        <div class="label_sl margin-bottom-5"
                                            style="display: flex; justify-content: space-around;width: 100%;font-size: 15px">
                                            <span style="font-size: 15px">Số lượng:</span>
                                            <input type="number" min="1" class="form-control"
                                                max="{{ $product->quantity }}" required
                                                style="width: 50%; margin-top:6px;margin-left: 15px;font-size: 15px"
                                                placeholder="Nhập số lượng" name="quantity">
                                        </div>
                                        @csrf
                                        <input type="hidden" value="{{ Auth::user()->id }}" name="user_id">
                                        <input type="hidden" value="{{ $product->id }}" name="product_id">
                                        <input type="hidden" value="{{ $product->price_new }}" name="price">
                                        <div>
                                            <button type="submit"
                                                class="btn btn_base btn_add_cart btn-cart add_to_cart">
                                                <span class="text_1">
                                                    Cho vào giỏ hàng
                                                </span>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            @endif

                        </div>
                    </div>
                </div>

            </div>
            {{-- End Product detail --}}
        </div>

        <div class="container" style="margin-bottom: 15px">
            <div class="row">
                <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12">
                    <section class="section_service_end">
                        <div class="owl-carousel owl-theme service_content_ not-nav owl-loaded owl-drag"
                            data-nav="false" data-dot="true" data-lg-items="3" data-md-items="3" data-xs-items="1"
                            data-sm-items="2" data-margin="15">
                            <div class="owl-stage-outer">
                                <div class="owl-stage"
                                    style="transform: translate3d(0px, 0px, 0px); transition: all 0s ease 0s; width: 1155px;display: flex">
                                    <div class="owl-item active" style="width: 370px; margin-right: 15px;">
                                        <div class="col-item-srv">
                                            <div class="service_item_ed">
                                                <span class="iconx">
                                                    <img class="lazyload loaded"
                                                        src="//bizweb.dktcdn.net/100/336/334/themes/802154/assets/service_1.png?1638756922886"
                                                        data-src="//bizweb.dktcdn.net/100/336/334/themes/802154/assets/service_1.png?1638756922886"
                                                        alt="Giao hàng toàn quốc" data-was-processed="true">
                                                </span>
                                                <div class="content_srv">
                                                    <span class="title_service">Giao hàng toàn quốc</span>
                                                    <span class="content_service">Giao hàng toàn quốc với mức phí ưu
                                                        đãi
                                                        nhất</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item active" style="width: 370px; margin-right: 15px;">
                                        <div class="col-item-srv">
                                            <div class="service_item_ed">
                                                <span class="iconx">
                                                    <img class="lazyload loaded"
                                                        src="//bizweb.dktcdn.net/100/336/334/themes/802154/assets/service_2.png?1638756922886"
                                                        data-src="//bizweb.dktcdn.net/100/336/334/themes/802154/assets/service_2.png?1638756922886"
                                                        alt="Hỗ trợ khách hàng" data-was-processed="true">
                                                </span>
                                                <div class="content_srv">
                                                    <span class="title_service">Hỗ trợ khách hàng</span>
                                                    <span class="content_service">Hỗ trợ khách hàng 24/7 - Hãy gọi cho
                                                        chúng
                                                        tôi</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="owl-item active" style="width: 370px; margin-right: 15px;">
                                        <div class="col-item-srv">
                                            <div class="service_item_ed">
                                                <span class="iconx">
                                                    <img class="lazyload loaded"
                                                        src="//bizweb.dktcdn.net/100/336/334/themes/802154/assets/service_3.png?1638756922886"
                                                        data-src="//bizweb.dktcdn.net/100/336/334/themes/802154/assets/service_3.png?1638756922886"
                                                        alt="Mua hàng giá ưu đãi" data-was-processed="true">
                                                </span>
                                                <div class="content_srv">
                                                    <span class="title_service">Mua hàng giá ưu đãi</span>
                                                    <span class="content_service">Cơ hội nhận khuyến mãi &amp; giá sốc
                                                        cuối
                                                        tuần</span>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section>
                </div>
            </div>
        </div>

        <div class="container">
            <div class="row">
                <div class="tab_h">
                    <div class="col-xs-12 col-lg-12 col-sm-12 col-md-12">
                        <div class="product-tab e-tabs">
                            <div class="tabs tabs-title clearfix">
                                <li class="tab-link current" data-tab="tab-1">
                                    <h3><span>Mô tả sản phẩm</span></h3>
                                </li>
                            </div>
                        </div>
                        <div id="tab-1" class="tab-content current" style="margin-top: 15px">
                            <div class="rte">
                                <p style="font-size: 15px">{!! $product->description !!}</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            {{-- <div class="col-lg-12 related-product margin-bottom-30" style="margin-top: 35px">
                <div class="section_prd_feature">
                    <div class="module-header">
                        <div class="heading title_product_base heading_hotdeal">
                            <h2>
                                <a href="" title="Sản phẩm liên quan">Sản phẩm liên quan</a>
                            </h2>
                        </div>
                    </div>
                </div>
            </div> --}}
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
