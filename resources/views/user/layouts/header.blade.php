<style>
    .menu {
        display: block;
        float: left;
        width: 100%;
        height: 60px;
        background-color: #ff6564;
    }

    .header nav {
        font-family: "Montserrat", sans-serif;
    }

    .header-nav>ul.item_big {
        text-align: left;
        margin: 0;
        padding: 0;
    }

    .header-nav>ul.item_big>li.nav-item {
        font-family: 'Helvetica Neue';
        font-weight: 400;
        display: inline-block;
        float: none;
        position: relative;
        margin-right: 0px;
        margin-left: 1px;
    }

    .header-nav>ul.item_big>li.nav-item>a {
        display: block;
        text-align: left;
        padding: 0px 20px;
        font-size: 15px;
        font-family: 'Helvetica Neue';
        font-weight: 400;
        height: 60px;
        line-height: 60px;
        position: relative;
        text-decoration: none;
        text-transform: uppercase;
        color: #fff;
    }
</style>
<header>
    <div style="background-color: #fff3f3;height: 155px;">
        <div class="container" style="justify-items: center;">
            <div class="row" style="margin-top: 40px; ">
                <div class="content_header ">
                    <div class="header-main" style="display: flex; justify-content: center;">
                        <!-- Logo -->
                        <div class="col-lg-3 col-md-3">
                            <div class="logo">
                                <img src="https://bizweb.dktcdn.net/100/336/334/themes/802154/assets/logo.png?1638756922886"
                                    alt="">
                            </div>
                        </div>
                        <!-- End Logo -->

                        <!-- Search -->
                        <div style="justify-self: center;">
                            <form class="w-100 position-relative mb-5"
                                style="border:1px solid #ff9897; border-radius: 30px;" action="{{route('search-product')}}" method="POST">
                                @csrf
                                <input type="hidden">
                                <span
                                    class="svg-icon svg-icon-2 svg-icon-lg-1 svg-icon-gray-500 position-absolute top-50 ms-5 translate-middle-y">
                                    <svg width="24" height="24" viewBox="0 0 24 24" fill="none"
                                        xmlns="http://www.w3.org/2000/svg" style="margin-left: 266px">
                                        <rect opacity="0.5" x="17.0365" y="15.1223" width="8.15546"
                                            height="2" rx="1" transform="rotate(45 17.0365 15.1223)"
                                            fill="currentColor"></rect>
                                        <path
                                            d="M11 19C6.55556 19 3 15.4444 3 11C3 6.55556 6.55556 3 11 3C15.4444 3 19 6.55556 19 11C19 15.4444 15.4444 19 11 19ZM11 5C7.53333 5 5 7.53333 5 11C5 14.4667 7.53333 17 11 17C14.4667 17 17 14.4667 17 11C17 7.53333 14.4667 5 11 5Z"
                                            fill="currentColor"></path>
                                    </svg>
                                </span>
                                <input type="text" class="form-control form-control-lg form-control-solid px-15"
                                    name="search" value="" placeholder="Search" style="border-radius:30px ;font-size:25px">
                            </form>
                        </div>
                        <!-- End Search -->

                        <div class="col-lg-2 col-md-2 col-sm-12 col-xs-12" style="justify-content: center;">
                            <div class="user">
                                <ul style="list-style: none;display:flex;margin-left: 15px;">
                                    <li>
                                        @if (empty(Auth::user()->id))
                                            <a href="{{ route('login') }}">
                                                <img src="https://bizweb.dktcdn.net/100/336/334/themes/802154/assets/businessman.svg?1638756922886"
                                                    alt="" style="height: 50px;width: 50px;">
                                            </a>
                                        @else
                                            <a href="{{route('profile.index')}}">
                                                <img src="https://bizweb.dktcdn.net/100/336/334/themes/802154/assets/businessman.svg?1638756922886"
                                                    alt="" style="height: 50px;width: 50px;">
                                            </a>
                                        @endif
                                    </li>
                                    <li style="margin-left: 15px;">
                                        <a href="{{ route('cartProduct') }}">
                                            <img src="https://bizweb.dktcdn.net/100/336/334/themes/802154/assets/shopping-cart.svg?1638756922886"
                                                alt="" style="height: 50px;width: 50px;">
                                        </a>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="menu">
        <div class="container">
            <div class="row">
                <div class="col-lg-12 col-md-12 col-sm-12 col-xs-12">
                    <nav class="header-nav">
                        <ul class="item_big">
                            <li class="nav-item ">
                                <a class="a-img" href="{{ route('trang-chu') }}">
                                    <span>TRANG CHỦ</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="a-img" href="{{ route('product.index') }}">
                                    <span>SẢN PHẨM</span>
                                </a>
                            </li>
                            <li class="nav-item ">
                                <a class="a-img" href="">
                                    <span>Giới thiệu</span>
                                </a>
                            </li>
                        </ul>
                    </nav>
                </div>
            </div>
        </div>
    </div>
    
</header>
