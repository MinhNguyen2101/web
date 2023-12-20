@extends('admin.layouts.app')
@section('contents')
    <style>
        /* The switch - the box around the slider */
        body {
            font-size: 15px !important
        }

        #table_product_filter .form-control {
            font-size: 18px;
            border: 1px solid;
            margin: 10px;
            border-radius: 15px
        }

        #table_product_length label {
            font-size: 18px !important
        }

        .switch {
            position: relative;
            display: inline-block;
            width: 60px;
            height: 34px;
        }

        /* Hide default HTML checkbox */
        .switch input {
            opacity: 0;
            width: 0;
            height: 0;
        }

        #table_product_filter .form-control {
            font-size: 18px;
            border: 1px solid;
            margin: 10px;
            border-radius: 15px
        }

        #table_product_length label {
            font-size: 18px !important
        }

        .page-link {
            width: 75px !important;
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
            <h1 style="flex: 1">Sản phẩm</h1>
            {{-- <a href="{{ route('admin.export.products') }}" class="btn btn-success">Export sản phẩm</a> --}}

            {{-- <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group input-group-outline">
                    <form action="/admin/product" method="get">
                        <label class="form-label"></label>
                        <input type="text" class="form-control" placeholder="Name/ Enter for submit" name="search"/>
                        <button>Đòng ý</button>
                    </form>
                </div>
            </div> --}}
            <button type="button" class="btn bg-gradient-success btn_create" data-bs-toggle="modal"
                data-bs-target="#modal-create">Thêm</button>
        </div>
        @include('admin.product.create')
        @include('admin.product.update')

        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center mb-0" style="width:100%" id="table_product">
                    <thead>
                        <tr>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 justify-content-center">
                                ID</th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 justify-content-center">
                                Tên
                            </th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 justify-content-center">
                                Ảnh
                            </th>

                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 justify-content-center">
                                Số lượng
                            </th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 justify-content-center">
                                Giá mới
                            </th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 justify-content-center">
                                Giá cũ
                            </th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 justify-content-center">
                                Danh mục
                            </th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 justify-content-center">
                                Trạng thái
                            </th>
                            <th
                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 justify-content-center">
                                Thời gian tạo</th>
                            <th
                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 justify-content-center">
                                Thời gian cập nhật</th>

                            <th class="text-secondary opacity-7 justify-content-center">Cập nhật</th>
                        </tr>
                    </thead>
                    <tbody>

                    </tbody>
                </table>

            </div>
        </div>
    </div>
    @push('page_script')
        <script>
            $(document).ready(function() {
                $('#table_product').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('admin.dataForTable') }}",
                    "columns": [{
                            "data": "id"
                        },
                        {
                            "data": "name"
                        },
                        {
                            "data": "image",
                            "render": function(data, type, row) {
                                return '<img src="' + data + '" class="card-img-top" alt="...">';
                            }
                        },
                        {
                            "data": "quantity"
                        },
                        
                        {
                            "data": "price_new"
                        },
                        {
                            "data": "price_old"
                        },
                        {
                            "data": "category"
                        },
                        {
                            "data": "status",
                            "render": function(data, type, row) {
                                var route = "{{ route('admin.changeStatus') }}";
                                return '<label class="switch">' +
                                    '<input data-id="' + row.id + '" class="toggle-class" type="checkbox" ' +
                                    'data-onstyle="success" data-offstyle="danger" data-toggle="toggle" ' +
                                    'data-on="Active" data-off="InActive" ' +
                                    'data-url="' + route + '" ' +
                                    (row.status == 1 ? 'checked' : '') + '>' +
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
                            "render": function(data, type, row) {
                                var editRoute = "{{ route('admin.product.edit', ':id') }}";
                                editRoute = editRoute.replace(':id', row.id);

                                return '<a href="javascript:;" class="text-secondary font-weight-normal text-xs" ' +
                                    'data-bs-target="#modal-update" data-bs-toggle="modal" ' +
                                    'data-url="' + editRoute + '">' +
                                    '<button type="button" class="btn btn-secondary edit_product" ' +
                                    'data-url="' + editRoute + '">Cập nhật</button>' +
                                    '</a>';
                            }


                        },

                    ],
                    "searching": true,
                });
            });


            $(function() {
                $(document).on('change', '.toggle-class', function() {
                var status = $(this).prop('checked') == true ? 1 : 0;
                var product_id = $(this).data('id');
                var url = $(this).data('url');
                
                $.ajax({
                    type: "GET",
                    dataType: "json",
                    url: url,
                    data: {
                        'status': status,
                        'product_id': product_id
                    },
                    success: function(data) {
                            window.location.href = "{{ route('admin.product.index') }}";
                        }
                    });
                })
            });


            // CREATE
            $(document).on('click', '.btn_create', function() {
                let url = $(this).data('url');
                let form = $('form.form_create');
                $('.error').html('');

                form.find('.value_input').val('');
            });

            $(document).on('click', '.btn-save', function(evt) {
                evt.preventDefault();
                let form = $('form.form_create');
                let url = form.attr('action');
                var formData = new FormData(document.getElementById("form_create"));

                $.ajax({
                    url: `${url}`,
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    success: function(data) {
                        let dataResult = JSON.parse(data);

                        $('.error').html('');

                        if (dataResult.statusCode === 422) {
                            let errors = dataResult.message;

                            for (let field of Object.keys(errors)) {
                                $(`.${field}_error`).html(errors[field][0]);
                            }
                        } else {
                            $('#modal-create').modal('hide');
                            window.location.href = "{{ route('admin.product.index') }}";
                        }
                    }
                });
            });

            // show form edit
            $(document).on('click', '.edit_product', function() {
                let url = $(this).data('url');
                $('.error').html('');
                $.ajax({
                    url: `${url}`,
                    type: "GET",
                    data: {},
                    cache: false,
                    success: function(data) {
                        console.log(data);
                        let id = data.product.id;
                        let route = "{{ route('admin.product.index') }}" + `/${id}`;
                        let form = $('form.form_edit');
                        form.attr('action', route);

                        form.find('.name').val(data.product.name);
                        form.find('.price_old').val(data.product.price_old);
                        form.find('.price_new').val(data.product.price_new);
                        form.find('.quantity').val(data.product.quantity);
                        form.find('.category_id').val(data.product.category_id);
                        form.find('.supplier_id').val(data.product.supplier_id);
                        form.find('.status').val(data.product.status);
                        form.find('.description').val(data.product.description);
                    }
                });
            });

            // update
            $(document).on('click', '.btn-update', function() {
                let form = $('form.form_edit');
                let url = form.attr('action');
                console.log(url)
                var formData = new FormData(document.getElementById("form_edit"));
                $.ajax({
                    url: `${url}`,
                    type: "POST",
                    data: formData,
                    cache: false,
                    contentType: false,
                    processData: false,
                    headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                    },
                    success: function(data) {
                        let dataResult = JSON.parse(data);

                        if (dataResult.statusCode === 422) {
                            let errors = dataResult.message;

                            for (let field of Object.keys(errors)) {
                                $(`.${field}_error`).html(errors[field][0]);
                            }
                        } else {
                            $('#modal-update').modal('hide');
                            window.location.href = "{{ route('admin.product.index') }}";
                        }
                    }
                });
            });

            // DELETE
            $(document).on('click', '.button-delete', function(e) {
                e.preventDefault();
                let url = $(this).data('url');
                var id = $(this).data('id');
                console.log(url);
                Swal.fire({
                        title: "Bạn chắc chắn không?",
                        // text: "{{ __('messages.once_delete') }}",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "Đồng ý"
                    })
                    .then((result) => {
                        if (result.isConfirmed) {
                            $.ajax({
                                url: url,

                                type: 'post',
                                headers: {
                                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                                },
                                data: {
                                    "_token": "{{ csrf_token() }}",
                                    _method: "DELETE",
                                    'id': id
                                },
                                cache: false,
                                success: function(data) {
                                    window.location.reload();
                                },
                            });
                        }
                    });
            });
        </script>
    @endpush
@endsection
