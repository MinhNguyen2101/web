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
            <h1 style="flex: 1">Đơn hàng mới </h1>
            {{-- <button type="button" class="btn bg-gradient-success btn_create_order" data-bs-toggle="modal"
                data-bs-target="#modal-create">Create</button> --}}
        </div>
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
                                Total Price</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                style="width: 100px">
                                Address</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                style="width: 100px">
                                Status</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"
                                style="width: 100px">
                                Đã xử lý</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Created at</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Updated at</th>
                            <th class="text-secondary text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            </th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($orders as $order)
                            <tr>
                                <div class="d-flex px-2 py-1">
                                    <td>
                                        {{ $order->id }}
                                    </td>
                                </div>
                                <td>
                                    <div class="d-flex flex-column justify-content-center">
                                        <h6 class="mb-0 ">{{ $order->user->name }}</h6>
                                        <p class="text-secondary mb-0">{{ $order->user->email }}</p>
                                    </div>
                                </td>
                                <td class="align-middle text-center">
                                    {{ number_format($order->total_price) }}
                                </td>
                                <td class="align-middle text-center text-sm">
                                    {{ $order->address }}
                                </td>

                                <td class="align-middle text-center text-sm">
                                    @if ($order->status === 1)
                                        <span class="badge bg-gradient-secondary">Đơn hàng mới</span>
                                    @elseif($order->status === 2)
                                        <span class="badge bg-gradient-danger"> Đơn hàng đang xử lý</span>
                                    @elseif($order->status === 3)
                                        <span class="badge bg-gradient-success">Giao hàng thành công</span>
                                    @else
                                        <span class="badge bg-gradient-danger">Đơn hàng bị hủy</span>
                                    @endif
                                </td>
                                <td>
                                    <label class="switch">
                                        <input data-id="{{ $order->id }}" class="toggle-class" type="checkbox"
                                            data-onstyle="success" data-offstyle="danger" data-toggle="toggle"
                                            data-on="Active" data-off="InActive"
                                            data-url="{{ route('admin.changeStatusOrder') }}"
                                            {{ $order->status == 2 ? 'checked' : '' }}>
                                        <span class="slider round"></span>
                                    </label>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-normal">{{ $order->created_at }}</span>
                                </td>
                                <td class="align-middle text-center">
                                    <span class="text-secondary text-xs font-weight-normal">{{ $order->updated_at }}</span>
                                </td>
                                <td class="align-middle" style="width: 15%">
                                    {{-- <a href="javascript:;" class="text-secondary font-weight-normal text-xs"
                                        data-bs-target="#modal-update" data-bs-toggle="modal"
                                        data-url="{{ route('admin.order.edit', $order->id) }}">
                                        <button type="button" class="btn btn-secondary edit_order"
                                            data-url="{{ route('admin.order.edit', $order->id) }}">Edit</button>
                                    </a> --}}
                                    <a href="{{ route('admin.order.show', $order->id) }}">
                                        <button type="button" class="btn btn-info">Info</button>
                                    </a>
                                    {{-- <a href="javascript:;" class="text-secondary font-weight-normal text-xs"
                                        data-toggle="tooltip" data-original-title="Edit user">
                                        <button type="button" class="btn btn-danger button-delete"
                                            data-id="{{ $order->id }}"
                                            data-url="{{ route('admin.order.destroy', $order->id) }}">Delete</button>
                                    </a> --}}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
                {{ $orders->links() }}
            </div>
        </div>
    </div>
    @push('page_script')
        <script>
            $(function() {
                $('.toggle-class').change(function() {
                    var status = $(this).prop('checked') == true ? 2 : 1;
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
        </script>
    @endpush
@endsection
