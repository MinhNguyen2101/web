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
        #table_order_success_filter .form-control {
            font-size: 18px;
            border: 1px solid;
            margin: 10px;
            border-radius: 15px
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
            <h1 style="flex: 1">Đơn hàng được giao thành công</h1>
            {{-- <button type="button" class="btn bg-gradient-success btn_create_order" data-bs-toggle="modal"
                data-bs-target="#modal-create">Create</button> --}}
        </div>
        <div class="card">
            <div class="table-responsive">
                <table class="table align-items-center mb-0" style="width:100%" id = "table_order_success">
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
                            <th class="text-secondary text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">
                            </th>
                        </tr>
                    </thead>
                    
                </table>
            </div>
        </div>
    </div>

    <script>
        $(document).ready(function () {
                $('#table_order_success').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": "{{ route('admin.dataForTableOrderSucess') }}",
                    "columns": [
                { "data": "id" },
                { "data": "user" },
                { "data": "total_price" },
                { "data": "address" },
                { "data": "status" },
                { "data": "created_at" },
                { "data": "updated_at" },
                {
                    "data": "info",
                    "render" : function (data, type, row) {
                        var editRoute = "{{ route('admin.order.show', ':id') }}";
                        editRoute = editRoute.replace(':id', row.id);

                        return '<a href="'+ editRoute +'">'+
                                        '<button type="button" class="btn btn-info">Info</button>'+
                                    '</a>'
                    }
                }
            ]

                });
        });
</script>
    
@endsection
