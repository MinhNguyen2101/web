<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css">
    <script src="https://kit.fontawesome.com/42d5adcbca.js" crossorigin="anonymous"></script>
    <link id="pagestyle" href="{{ asset('assets/css/material-dashboard.css?v=3.0.2') }}" rel="stylesheet" />
    <script src="https://code.jquery.com/jquery-3.6.3.min.js"
        integrity="sha256-pvPw+upLPUjgMXY0G+8O0xUf+/Im1MZjXxxgOcBQBXU=" crossorigin="anonymous"></script>

    <link rel="stylesheet" type="text/css"
        href="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/toastr.min.css">

    <script src="https://cdnjs.cloudflare.com/ajax/libs/toastr.js/latest/js/toastr.min.js"></script>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>


    <title>Document</title>
</head>

<body>
    <style>
        * {
            box-sizing: border-box;
        }

        html,
        body {
            width: 100%;
            height: 100%;
            margin: 0;
            background-color: #ff98971f;
            font-family: 'Roboto', sans-serif;
        }

        .shopping-cart {
            margin: 80px auto;
            background: #FFFFFF;
            box-shadow: 1px 2px 3px 0px rgba(0, 0, 0, 0.10);
            border-radius: 6px;
            display: flex;
            flex-direction: column;
        }

        .total {
            margin: 80px auto;
            background: #FFFFFF;
            box-shadow: 1px 2px 3px 0px rgba(0, 0, 0, 0.10);
            border-radius: 6px;
            display: flex;
            flex-direction: column;
        }

        .title {
            height: 60px;
            border-bottom: 1px solid #E1E8EE;
            padding: 20px 30px;
            color: #5E6977;
            font-size: 18px;
            font-weight: 400;
        }

        .item {
            padding: 20px 30px;
            display: flex;
        }

        .item:nth-child(3) {
            border-top: 1px solid #E1E8EE;
            border-bottom: 1px solid #E1E8EE;
        }

        .buttons {
            position: relative;
            padding-top: 30px;
            margin-right: 60px;
        }

        .delete-btn,
        .like-btn {
            display: inline-block;
            Cursor: pointer;
        }

        .delete-btn {
            width: 18px;
            height: 17px;
            background: url(https://designmodo.com/demo/shopping-cart/delete-icn.svg) no-repeat center;
        }

        .is-active {
            animation-name: animate;
            animation-duration: .8s;
            animation-iteration-count: 1;
            animation-timing-function: steps(28);
            animation-fill-mode: forwards;
        }

        @keyframes animate {
            0% {
                background-position: left;
            }

            50% {
                background-position: right;
            }

            100% {
                background-position: right;
            }
        }

        .image {
            margin-right: 50px;
        }

        .description {
            padding-top: 10px;
            margin-right: 20px;
            width: 115px;
        }

        .description span {
            display: block;
            font-size: 14px;
            color: #43484D;
            font-weight: 400;
        }

        .description span:first-child {
            margin-bottom: 5px;
        }

        .description span:last-child {
            font-weight: 300;
            margin-top: 8px;
            color: #86939E;
        }

        .quantity {
            padding-top: 20px;
            margin-right: 60px;
        }

        .quantity input {
            -webkit-appearance: none;
            border: none;
            text-align: center;
            width: 32px;
            font-size: 16px;
            color: #43484D;
            font-weight: 300;
        }

        button[class*=btn] {
            width: 30px;
            height: 30px;
            background-color: #E1E8EE;
            border-radius: 6px;
            border: none;
            cursor: pointer;
        }

        .minus-btn img {
            margin-bottom: 3px;
        }

        .plus-btn img {
            margin-top: 2px;
        }

        button:focus,
        input:focus {
            outline: 0;
        }

        .total-price {
            width: 83px;
            padding-top: 27px;
            text-align: center;
            font-size: 16px;
            color: #43484D;
            font-weight: 300;
            margin-right: 20px;
            margin-left: 20px;
        }

        @media (max-width: 800px) {
            .shopping-cart {
                width: 100%;
                height: auto;
                overflow: hidden;
            }

            .item {
                height: auto;
                flex-wrap: wrap;
                justify-content: center;
            }

            .image img {
                width: 50%;
            }

            .image,
            .quantity,
            .description {
                width: 100%;
                text-align: center;
                margin: 6px 0;
            }

            .buttons {
                margin-right: 20px;
            }
        }

        /* button Thanh toan */
        .wrap_btn {
            padding: 0px 20px;
            margin-top: 25px;
        }

        .btn-proceed-checkout {
            text-align: center;
            display: block;
            padding: 6px 15px;
            width: 100%;
            font-family: "Montserrat", sans-serif;
            font-size: 14px;
            margin-left: 0px;
            text-transform: none;
            background: #ff9897;
            color: #fff;
            font-weight: bold;
            border-radius: 30px;
            border: 1px solid #ff9897;
        }

        .li_table {
            border-bottom: solid 1px #ebebeb;
            height: 50px;
            line-height: 50px;
        }

        .li_table .li-left.li_text {
            font-weight: bold;
        }

        .li_table .li-left {
            float: left;
            font-size: 14px;
            color: #000;
            line-height: 50px;
        }

        .li_table .totals_price {
            font-weight: bold;
            font-family: "Montserrat", sans-serif;
            font-size: 18px;
            color: #ff9897;
            font-weight: bold;
            line-height: 50px;
        }

        .li_table .li-right {
            float: right;
        }

        .container {
            max-width: 1500px;
        }

        .table-cart thead {
            border-bottom: 2px solid black;
            padding-bottom: 10px;
        }

        .table-cart td {
            padding-top: 20px;
            padding-bottom: 20px;
        }
    </style>
    @include('user.layouts.header')
    <div class="container">
        <div class="row d-flex">
            <div class="shopping-cart" style="flex: 7;margin:100px">
                <!-- Title -->
                <div class="title">
                    <div style="display: flex">
                        <div>
                            Shopping Bag
                        </div>
                    </div>
                </div>
                <table class="table-cart">
                    <thead style="font-size: 15px; color: #ff9897;margin-bottom: 50px">
                        <th></th>
                        <th>Sản phẩm</th>
                        <th>Giá tiền</th>
                        <th>Thành tiền</th>
                        <th>Số lượng</th>
                        <th></th>
                    </thead>
                    <!-- Product #1 -->
                    <tbody>
                        <div class="item">
                            @foreach ($productCart as $item)
                                <tr>

                                    <td>
                                        <div class="buttons">
                                            <form action="{{ route('deleteProduct') }}" method="POST"
                                                id="delete_product" class="delete_product">
                                                @csrf
                                                <input type="hidden" value="{{ $item->id }}" name="cart_id">
                                                <button type="button" class="delete-btn" id="button_delete"
                                                    data-url="{{ route('deleteProduct') }} "
                                                    data-id="{{ $item->id }}"></button>
                                            </form>
                                        </div>
                                    </td>
                                    <td style="display: flex">
                                        <div class="image">
                                            <img style="width: 120px;height: 80px;"
                                                src="{{ asset('storage') }}/{{ $item->product->image }}"
                                                alt="" />
                                        </div>
                                        <div class="description" style="width: 50%">
                                            <span
                                                style="
                                                    overflow: hidden;
                                                    text-overflow: ellipsis;
                                                    line-height: 25px;
                                                    -webkit-line-clamp: 2;
                                                    height: 50px;
                                                    display: -webkit-box;
                                                    -webkit-box-orient: vertical;">
                                                {{ $item->product->name }}
                                            </span>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="total-price">{{ number_format($item->product->price_new) }}
                                        </div>
                                    </td>
                                    <td>
                                        <div class="total-price" style="color: #ff9897,">
                                            {{ number_format($item->product->price_new * $item->quantity) }}
                                        </div>
                                    </td>
                                    <td>
                                        <form action="{{ route('update-quantity') }}" method="POST"
                                            style="display: flex">
                                            @csrf
                                            <input type="hidden" value="{{ $item->product_id }}" name="product_id">
                                            <input type="number" class="form-control" min="1"
                                                value="{{ $item->quantity }}" max="{{ $item->product->quantity }}"
                                                name="quantity_new"
                                                style=" margin-top: 24px;
                                                        width: 75px;
                                                        height: 50%; font-size: 15px">
                                            <button class="btn btn-secondary"
                                                style="margin-top: 25px;width: 75px;font-size: 12px;margin-left: 15px"
                                                type="submit">Update</button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </div>

                    </tbody>
                </table>
                {{-- End Item --}}
            </div>
            <div class="total" style="flex: 3;height: 250px;margin-top:100px">
                <h1> Total</h1>
                <div>
                    <div class="li_table shopping-cart-table-total">
                        <span class="li-left li_text">
                            Thành tiền:
                        </span>
                        <span class="li-right totals_price price">
                            <?php
                            $total = 0;
                            foreach ($productCart as $item) {
                                $total = $total + $item->product->price_new * $item->quantity;
                            }
                            ?>
                            {{ number_format($total) }}
                        </span>
                    </div>
                    @if (count($productCart) > 0)
                        <div class="wrap_btn">
                            <a class="button btn-proceed-checkout" title="Tiến hành thanh toán" type="button"
                                onclick="window.location.href='/checkout'">
                                <span>Tiến hành thanh toán</span>
                            </a>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
    @include('user.layouts.footer')
    <script></script>
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

        $(document).on('click', '#button_delete', function(evt) {
            Swal.fire({
                title: 'Are you sure?',
                text: "You won't be able to revert this!",
                icon: 'warning',
                showCancelButton: true,
                confirmButtonColor: '#3085d6',
                cancelButtonColor: '#d33',
                confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
                if (result.isConfirmed) {
                    let form = $('form.delete_product');
                    let url = form.attr('action');
                    var formData = new FormData(document.getElementById("delete_product"));
                    console.log(form);
                    $.ajax({
                        url: `${url}`,
                        type: "POST",
                        data: formData,
                        cache: false,
                        contentType: false,
                        processData: false,
                        success: function(data) {
                            window.location.reload();
                            Swal.fire(
                                'Deleted!',
                                'Your file has been deleted.',
                                'success'
                            )
                        }
                    });

                }
            })
        })
    </script>
</body>

</html>
