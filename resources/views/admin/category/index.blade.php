@extends('admin.layouts.app')
@section('contents')
    <div style="padding:15px">
        <div style="display: flex">
            <h1 style="flex: 1">Category</h1>
            <button type="button" class="btn bg-gradient-success btn_create_category" data-bs-toggle="modal"
                data-bs-target="#modal-create">Create</button>
        </div>
        @include('admin.category.create')
        @include('admin.category.update')

        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7" style="width: 100px">
                                Description</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Created at</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Updated at</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($categories as $category)
                            <tr>
                                <div class="d-flex px-2 py-1">
                                    <td>
                                        {{ $category->id }}
                                    </td>
                                </div>
                                <td>
                                    {{ $category->name }}
                                </td>
                                <td class="align-middle text-center text-sm" style="width: 50%">
                                    {{ $category->description }}
                                </td>
                                <td class="align-middle text-center">
                                    <span
                                        class="text-secondary text-xs font-weight-normal">{{ $category->created_at }}</span>
                                </td>
                                <td>
                                    <span
                                        class="text-secondary text-xs font-weight-normal">{{ $category->updated_at }}</span>
                                </td>
                                <td class="align-middle" style="width: 15%">
                                    <a href="javascript:;" class="text-secondary font-weight-normal text-xs"
                                        data-bs-target="#modal-update" data-bs-toggle="modal"
                                        data-url="{{ route('admin.category.edit', $category->id) }}">
                                        <button type="button" class="btn btn-secondary edit_category"
                                            data-url="{{ route('admin.category.edit', $category->id) }}">Edit</button>
                                    </a>
                                    <a href="javascript:;" class="text-secondary font-weight-normal text-xs"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        <button type="button" class="btn btn-danger button-delete"
                                            data-id="{{ $category->id }}"
                                            data-url="{{ route('admin.category.destroy', $category->id) }}">Delete</button>
                                    </a>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $categories->links() }}
            </div>
        </div>
    </div>
    @push('page_script')
        <script>
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
