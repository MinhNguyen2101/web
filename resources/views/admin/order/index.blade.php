@extends('admin.layouts.app')
@section('contents')
    <div style="padding:15px">
        <div style="display: flex">
            <h1 style="flex: 1">Order</h1>
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
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Created at</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                                Updated at</th>
                            <th class="text-secondary text-uppercase text-secondary text-xxs font-weight-bolder opacity-7"></th>
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
                                    {{ $order->status }}
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
                                    <a href="{{route('admin.order.show',$order->id)}}">
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
@endsection
