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
            <h1 style="flex: 1">Product</h1>
            <button type="button" class="btn bg-gradient-success btn_create" data-bs-toggle="modal"
                data-bs-target="#modal-create">Create</button>
        </div>
        @include('admin.product.create')
        @include('admin.product.update')

        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 justify-content-center">
                                ID</th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 justify-content-center">
                                Product
                            </th>

                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 justify-content-center">
                                Quantity
                            </th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 justify-content-center">
                                Price New
                            </th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 justify-content-center">
                                Price Old
                            </th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 justify-content-center">
                                Category
                            </th>
                            <th
                                class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2 justify-content-center">
                                Status
                            </th>
                            <th
                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 justify-content-center">
                                Created at</th>
                            <th
                                class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 justify-content-center">
                                Updated at</th>
                            <th class="text-secondary opacity-7 justify-content-center"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                            <tr>
                                <div class="d-flex px-2 py-1 justify-content-center">
                                    <td>
                                        {{ $product->id }}
                                    </td>
                                </div>
                                <td>
                                    <div class="d-flex px-2 py-1 justify-content-center">
                                        <div style="width: 125px;">
                                            <img src="{{ asset('storage/' . $product->image) }}" class="card-img-top"
                                                alt="...">
                                        </div>
                                        <div class="d-flex flex-column justify-content-center">
                                            <h6 class="mb-0 text-xs">{{ $product->name }}</h6>
                                        </div>
                                    </div>
                                </td>
                                <td>
                                    {{ $product->quantity }}
                                </td>
                                <td>
                                    {{ $product->price_new }}
                                </td>
                                <td>
                                    {{ $product->price_old }}
                                </td>
                                <td>
                                    {{ $product->category->name }}
                                </td>
                                <td>
                                    <label class="switch">
                                        <input data-id="{{ $product->id }}" class="toggle-class" type="checkbox"
                                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                            data-on="Active" data-off="InActive"
                                            data-url="{{ route('admin.changeStatus') }}"
                                            {{ $product->status == 1 ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td class="align-middle text-center">
                                    <span
                                        class="text-secondary text-xs font-weight-normal">{{ $product->created_at }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-secondary text-xs font-weight-normal">{{ $product->updated_at }}</span>
                                </td>
                                <td class="align-middle" style="width: 15%">
                                    <a href="javascript:;" class="text-secondary font-weight-normal text-xs"
                                        data-bs-target="#modal-update" data-bs-toggle="modal"
                                        data-url="{{ route('admin.product.edit', $product->id) }}">
                                        <button type="button" class="btn btn-secondary edit_product"
                                            data-url="{{ route('admin.product.edit', $product->id) }}">Edit</button>
                                    </a>
                                    {{-- <a href="javascript:;" class="text-secondary font-weight-normal text-xs"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        <button type="button" class="btn btn-danger button-delete"
                                            data-id="{{ $product->id }}"
                                            data-url="{{ route('admin.product.destroy', $product->id) }}">Delete</button>
                                    </a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $products->links() }}
            </div>
        </div>
    </div>
    @push('page_script')
        <script>
            $(function() {
                $('.toggle-class').change(function() {
                    var status = $(this).prop('checked') == true ? 1 : 0;
                    var product_id = $(this).data('id');
                    let url = $(this).data('url');
                    $.ajax({
                        type: "GET",
                        dataType: "json",
                        url: `${url}`,
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
                        title: "Are you sure?",
                        // text: "{{ __('messages.once_delete') }}",
                        icon: 'warning',
                        showCancelButton: true,
                        confirmButtonColor: '#3085d6',
                        cancelButtonColor: '#d33',
                        confirmButtonText: "Yes,delete it!"
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
