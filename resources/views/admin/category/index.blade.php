@extends('admin.layouts.app')
@section('contents')
    <style>
        #table-category_filter .form-control {
            font-size: 18px;
            border: 1px solid;
            margin: 10px;
            border-radius: 15px
        }
        .text-description {
            overflow: hidden;
            white-space: nowrap; 
            text-overflow: ellipsis;
            width: 360px;
        }
        .page-link{
            width: 75px!important;
        }
    </style>
    <div style="padding:15px">
        <div style="display: flex">
            <h1 style="flex: 1">Danh mục</h1>
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
            </div>
            <button type="button" class="btn bg-gradient-success btn_create_category" data-bs-toggle="modal"
                data-bs-target="#modal-create">Thêm</button>
        </div>
        @include('admin.category.create')
        @include('admin.category.update')

        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center mb-0" style="width:100%" id="table-category">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Tên
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                style="width: 100px">
                                Mô tả</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Thời gian tạo</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Thời gian cập nhật</th>
                            <th>Cập nhật</th>
                            <th class="text-secondary opacity-7">Xóa</th>
                            <th></th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
    @push('page_script')
        <script>
            $(document).ready(function() {
                $('#table-category').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('admin.dataForTableCategory') }}",
                    "columns": [{
                            "data": "id"
                        },
                        {
                            "data": "name"
                        },
                        {
                            "data": "description",
                            'render': function(data, type, row){
                                return '<p class=" text-description" data-bs-toggle="tooltip" data-bs-placement="top" title="' + data + '"p>' + data+ '</p>'; 
                            }
                        },
                        {
                            "data": "created_at"
                        },
                        {
                            "data": "updated_at"
                        },
                        {
                            "data": "update",
                            "render": function(data, type, row) {
                                var editRoute = "{{ route('admin.category.edit', ':id') }}";
                                editRoute = editRoute.replace(':id', row.id);

                                return '<a href="javascript:;" class="text-secondary font-weight-normal text-xs" ' +
                                    'data-bs-target="#modal-update" data-bs-toggle="modal" ' +
                                    'data-url="' + editRoute + '">' +
                                    '<button type="button" class="btn btn-secondary edit_category" ' +
                                    'data-url="' + editRoute + '">Sửa</button>' +
                                    '</a>';
                            }

                        },
                        {
                            "data": "delete",
                            "render": function(data, type, row) {
                                var deleteRoute = "{{ route('admin.category.destroy', ':id') }}";
                                deleteRoute = deleteRoute.replace(':id', row.id);

                                return '<a href="javascript:;" class="text-secondary font-weight-normal text-xs" data-toggle="tooltip" data-original-title="Delete category">' +
                                    '<button type="button" class="btn btn-danger button-delete" data-id="' +
                                    row.id + '" data-url="' + deleteRoute + '">Xóa</button>' +
                                    '</a>';
                            }

                        },
                    ]

                });
            });

            $(document).on('click', '.button-delete', function() {
                var categoryId = $(this).data('id');
                var deleteUrl = $(this).data('url');

                // Implement your delete logic using categoryId and deleteUrl
            });



            // CREATE
            $(document).on('click', '.btn_create_category', function() {
                let url = $(this).data('url');
                let form = $('form.form_create');
                $('.error').html('');

                form.find('.value_input').val('');
            });

            $(document).on('click', '.btn-save', function() {
                let form = $('form.form_create');
                let url = form.attr('action');
                console.log(url);
                $.ajax({
                    url: `${url}`,
                    type: "POST",
                    data: form.serialize(),
                    cache: false,
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
                            window.location.href = "{{ route('admin.category.index') }}";
                        }
                    }
                });
            });

            // show form edit
            $(document).on('click', '.edit_category', function() {
                let url = $(this).data('url');
                $('.error').html('');
                $.ajax({
                    url: `${url}`,
                    type: "GET",
                    data: {},
                    cache: false,
                    success: function(data) {
                        let id = data.category.id;
                        let route = "{{ route('admin.category.index') }}" + `/${id}`;
                        let form = $('form.form_edit');
                        form.attr('action', route);

                        form.find('.name').val(data.category.name);
                        form.find('.description').val(data.category.description);
                    }
                });
            });

            // update
            $(document).on('click', '.btn-update', function() {
                let form = $('form.form_edit');
                let url = form.attr('action');
                console.log(url);
                $.ajax({
                    url: `${url}`,
                    type: "PUT",
                    data: form.serialize(),
                    cache: false,
                    success: function(data) {
                        let dataResult = JSON.parse(data);

                        if (dataResult.statusCode === 422) {
                            let errors = dataResult.message;

                            for (let field of Object.keys(errors)) {
                                $(`.${field}_error`).html(errors[field][0]);
                            }
                        } else {
                            $('#modal-update').modal('hide');
                            window.location.href = "{{ route('admin.category.index') }}";
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
