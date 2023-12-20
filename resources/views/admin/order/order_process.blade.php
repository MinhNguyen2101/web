@extends('admin.layouts.app')
@section('contents')
    <style>
        /* The switch - the box around the slider */
        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }
        #table_order_process_filter .form-control {
            font-size: 18px;
            border: 1px solid;
            margin: 10px;
            border-radius: 15px
        }
        .page-link{
            width: 75px!important;
        }

        #table_product_length label {
            font-size: 18px !important
        }


        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        /* The slider */
        .slider {
            position: absolute;
            cursor: pointer;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-color: #ccc;
            -webkit-transition: .4s;
            transition: .4s;
        }

        .slider:before {
            position: absolute;
            content: "";
            height: 26px;
            width: 26px;
            left: 4px;
            bottom: 4px;
            background-color: white;
            -webkit-transition: .4s;
            transition: .4s;
        }

        input:checked+.slider {
            background-color: #2196F3;
        }

        input:focus+.slider {
            box-shadow: 0 0 1px #2196F3;
        }

        input:checked+.slider:before {
            -webkit-transform: translateX(26px);
            -ms-transform: translateX(26px);
            transform: translateX(26px);
        }

        .slider.round {
            border-radius: 34px;
        }

        .slider.round:before {
            border-radius: 50%;
        }
    </style>
    <div style="padding:15px">
        <div style="display: flex">
            <h1 style="flex: 1">Đơn hàng đang được xử lý </h1>
            {{-- <button type="button" class="btn bg-gradient-success btn_create_order" data-bs-toggle="modal"
                data-bs-target="#modal-create">Thêm</button> --}}
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center mb-0" style="width:100%" id='table_order_process'>
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên
                            </th>

                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                style="width: 100px">
                                Tổng tiền</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                style="width: 100px">
                                Địa chỉ</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                style="width: 100px">
                                Trạng thái</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                style="width: 100px">
                                Giao thành công</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Thời gian tạo</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Thời gian cập nhật</th>
                            <th class="text-secondary text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            </th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @push('page_script')
        <script>
            $(function() {
                $(document).on('change', '.toggle-class', function() {
                    var status = $(this).prop('checked') == true ? 3 : 2;
                    var order_id = $(this).data('id');
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
                            window.location.href = "{{ route('admin.order.index') }}";
                        }
                    });
                })
            });

            $(document).ready(function() {
                $('#table_order_process').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('admin.getDataOrderProcess') }}",
                    "columns": [{
                            "data": "id"
                        },
                        {
                            "data": "user"
                        },
                        {
                            "data": "total_price"
                        },
                        {
                            "data": "address"
                        },
                        {
                            "data": "status"
                        },
                        {
                            "data": "changeStatus",
                            "render": function (data, type, row) {
                                var route = "{{ route('admin.changeStatusOrder') }}";
                                return '<label class="switch">' +
                                    '<input data-id="' + row.id + '" class="toggle-class" type="checkbox" ' +
                                    'data-onstyle="success" data-offstyle="danger" data-toggle="toggle" ' +
                                    'data-on="Active" data-off="InActive" ' +
                                    'data-url="' + route + '" ' +
                                    (row.status == 2 ? 'checked' : '') + '>' +
                                    '<span class="slider round"></span>' +
                                    '</label>';
                            }
                        },
                        {
                            "data": "created_at"
                        },
                        {
                            "data": "updated_at"
                        },
                        {
                            "data": "info",
                            "render": function(data, type, row) {
                                var editRoute = "{{ route('admin.order.show', ':id') }}";
                                editRoute = editRoute.replace(':id', row.id);

                                return '<a href="' + editRoute + '">' +
                                    '<button type="button" class="btn btn-info">Thông tin đơn hàng</button>' +
                                    '</a>'
                            }
                        }
                    ]

                });
            });
        </script>
    @endpush
@endsection
