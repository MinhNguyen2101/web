@extends('admin.layouts.app')
@section('contents')
    <div style="padding:15px">
        <div style="display: flex">
            <h1 style="flex: 1">Suppliers</h1>
            <div class="ms-md-auto pe-md-3 d-flex align-items-center">
                <div class="input-group input-group-outline">
                    <form action="/admin/category" method="get">
                        <label class="form-label"></label>
                        <input type="text" class="form-control" placeholder="Name/ Enter for submit" name="search"/>
                        <button>Submit </button>
                    </form>
                </div>
            </div>
            <button type="button" class="btn bg-gradient-success btn_create" data-bs-toggle="modal"
                data-bs-target="#modal-create">Create</button>
        </div>
        @include('admin.supplier.create')
        @include('admin.supplier.update')

        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Email
                            </th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Telephone
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                style="width: 100px">
                                Description</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Created at</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Updated at</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($suppliers as $supplier)
                            <tr>
                                <div class="d-flex px-2 py-1">
                                    <td>
                                        {{ $supplier->id }}
                                    </td>
                                </div>
                                <td>
                                    {{ $supplier->name }}
                                </td>
                                <td>
                                    {{ $supplier->email }}
                                </td>
                                <td>
                                    {{ $supplier->telephone }}
                                </td>
                                <div class="d-flex px-2 py-1">
                                    <td class="align-middle text-center text-sm">
                                        {{ $supplier->description }}
                                    </td>
                                </div>
                                <td class="align-middle text-center">
                                    <span
                                        class="text-secondary text-xs font-weight-normal">{{ $supplier->created_at }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-secondary text-xs font-weight-normal">{{ $supplier->updated_at }}</span>
                                </td>
                                <td class="align-middle" style="width: 15%">
                                    <a href="javascript:;" class="text-secondary font-weight-normal text-xs"
                                        data-bs-target="#modal-update" data-bs-toggle="modal"
                                        data-url="{{ route('admin.supplier.edit', $supplier->id) }}">
                                        <button type="button" class="btn btn-secondary edit_supplier"
                                            data-url="{{ route('admin.supplier.edit', $supplier->id) }}">Edit</button>
                                    </a>
                                    <a href="javascript:;" class="text-secondary font-weight-normal text-xs"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        <button type="button" class="btn btn-danger button-delete"
                                            data-id="{{ $supplier->id }}"
                                            data-url="{{ route('admin.supplier.destroy', $supplier->id) }}">Delete</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $suppliers->links() }}
            </div>
        </div>
    </div>
    @push('page_script')
        <script>
            // CREATE
            $(document).on('click', '.btn_create', function() {
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
                            window.location.href = "{{ route('admin.supplier.index') }}";
                        }
                    }
                });
            });

            // show form edit
            $(document).on('click', '.edit_supplier', function() {
                let url = $(this).data('url');
                $('.error').html('');
                $.ajax({
                    url: `${url}`,
                    type: "GET",
                    data: {},
                    cache: false,
                    success: function(data) {
                        let id = data.supplier.id;
                        let route = "{{ route('admin.supplier.index') }}" + `/${id}`;
                        let form = $('form.form_edit');
                        form.attr('action', route);

                        form.find('.name').val(data.supplier.name);
                        form.find('.email').val(data.supplier.email);
                        form.find('.telephone').val(data.supplier.telephone);
                        form.find('.address').val(data.supplier.address);
                        form.find('.description').val(data.supplier.description);
                    }
                });
            });

            // update
            $(document).on('click', '.btn-update', function() {
                let form = $('form.form_edit');
                let url = form.attr('action');
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
                            window.location.href = "{{ route('admin.supplier.index') }}";
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
