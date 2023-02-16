@extends('admin.layouts.app')
@section('contents')
    <div style="padding:15px">
        <div style="display: flex">
            <h1 style="flex: 1">User</h1>
            <button type="button" class="btn bg-gradient-success btn_create_user" data-bs-toggle="modal"
                data-bs-target="#modal-create">Create</button>
        </div>
        @include('admin.user.create')
        @include('admin.user.update')

        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center mb-0" style="width:100%">
                    <thead>
                        <tr>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">ID</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Name
                            </th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                style="width: 100px">
                                Email</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                style="width: 100px">
                                Role</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Created at</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Updated at</th>
                            <th class="text-secondary opacity-7"></th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($users as $user)
                            <tr>
                                <div class="d-flex px-2 py-1">
                                    <td>
                                        {{ $user->id }}
                                    </td>
                                </div>
                                <td>
                                    {{ $user->name }}
                                </td>
                                <td class="align-middle text-center text-sm" style="width: 50%">
                                    {{ $user->email }}
                                </td>
                                <td class="align-middle text-center text-sm" style="width: 50%">
                                    @if ($user->role == 1)
                                        <span class="badge badge-pill bg-gradient-primary">User</span>
                                    @else
                                        <span class="badge badge-pill badge-md bg-gradient-warning">Admin</span>
                                    @endif
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-normal">{{ $user->created_at }}</span>
                                </td>
                                <td>
                                    <span class="text-secondary text-xs font-weight-normal">{{ $user->updated_at }}</span>
                                </td>
                                <td class="align-middle" style="width: 15%">
                                    @if (Auth::user()->id == $user->id)
                                        {{-- <a href="javascript:;" class="text-secondary font-weight-normal text-xs"
                                            data-bs-target="#modal-update" data-bs-toggle="modal"
                                            data-url="{{ route('admin.user.edit', $user->id) }}"> --}}
                                            <button type="button" disabled class="btn btn-secondary edit_user"
                                                data-url="{{ route('admin.user.edit', $user->id) }}">Edit</button>
                                        </a>
                                    @else
                                        <a href="javascript:;" class="text-secondary font-weight-normal text-xs"
                                            data-bs-target="#modal-update" data-bs-toggle="modal"
                                            data-url="{{ route('admin.user.edit', $user->id) }}">
                                            <button type="button"  class="btn btn-secondary edit_user"
                                                data-url="{{ route('admin.user.edit', $user->id) }}">Edit</button>
                                        </a>
                                    @endif

                                    {{-- <a href="javascript:;" class="text-secondary font-weight-normal text-xs"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        <button type="button" class="btn btn-danger button-delete"
                                            data-id="{{ $user->id }}"
                                            data-url="{{ route('admin.user.destroy', $user->id) }}">Delete</button>
                                    </a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $users->links() }}
            </div>
        </div>
    </div>
    @push('page_script')
        <script>
            // CREATE
            $(document).on('click', '.btn_create_user', function() {
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
                            window.location.href = "{{ route('admin.user.index') }}";
                        }
                    }
                });
            });

            // show form edit
            $(document).on('click', '.edit_user', function() {
                let url = $(this).data('url');
                $('.error').html('');
                $.ajax({
                    url: `${url}`,
                    type: "GET",
                    data: {},
                    cache: false,
                    success: function(data) {
                        let id = data.user.id;
                        let route = "{{ route('admin.user.index') }}" + `/${id}`;
                        let form = $('form.form_edit');
                        form.attr('action', route);

                        form.find('.name').val(data.user.name);
                        form.find('.email').val(data.user.email);
                        if (data.user.role == 1) {
                            $(".select").
                            html(
                                "<select name=`role` class=`input-group`> <option value = `1` selected> User </option> <option value=`2`>Admin</option></select>"
                            );
                        } else {
                            $(".select").html(
                                "<select name=`role` class=`input-group`> <option value = `2` selected> Admin </option> <option value=`1`>User</option></select>"
                            );
                        }

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
                            window.location.href = "{{ route('admin.user.index') }}";
                        }
                    }
                });
            });

            // // DELETE
            // $(document).on('click', '.button-delete', function(e) {
            //     e.preventDefault();
            //     let url = $(this).data('url');
            //     var id = $(this).data('id');
            //     console.log(url);
            //     Swal.fire({
            //             title: "Are you sure?",
            //             // text: "{{ __('messages.once_delete') }}",
            //             icon: 'warning',
            //             showCancelButton: true,
            //             confirmButtonColor: '#3085d6',
            //             cancelButtonColor: '#d33',
            //             confirmButtonText: "Yes,delete it!"
            //         })
            //         .then((result) => {
            //             if (result.isConfirmed) {
            //                 $.ajax({
            //                     url: url,

            //                     type: 'post',
            //                     headers: {
            //                         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //                     },
            //                     data: {
            //                         "_token": "{{ csrf_token() }}",
            //                         _method: "DELETE",
            //                         'id': id
            //                     },
            //                     cache: false,
            //                     success: function(data) {
            //                         window.location.reload();
            //                     },
            //                 });
            //             }
            //         });
            // });
        </script>
    @endpush
@endsection
