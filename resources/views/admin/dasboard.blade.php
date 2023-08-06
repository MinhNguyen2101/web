@extends('admin.layouts.app')
@section('contents')
    <div style="margin-left: 200px;margin-top:50px">
        <div class="row">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">weekend</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Product</p>
                            <h4 class="mb-0">{{ $total_product }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        {{-- <p class="mb-0"><span class="text-success text-sm font-weight-bolder">+55% </span>than last week
                        </p> --}}
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-primary shadow-primary text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Users</p>
                            <h4 class="mb-0">{{ $total_user }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                        <p class="mb-0"><span class="text-success text-sm font-weight-bolder"></span>
                        </p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row" style="margin-top: 50px">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Category</p>
                            <h4 class="mb-0">{{ $total_category }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                       
                    </div>
                </div>
            </div>
            <div class="col-xl-3 col-sm-6">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-info shadow-info text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">weekend</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Total Money</p>
                            <h4 class="mb-0">{{ number_format($total_money) }} đ</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                      
                    </div>
                </div>
            </div>
        </div>
        <div id="chart-container" style="width: 366px;height:300px;margin-left:16%;margin-top:25px">
            <canvas id="graph"></canvas>
        </div>
    </div>

    @push('page_script')
        <script>
            $(document).ready(function() {
                showGraph();
            });


            function showGraph() {

                var pie = $("#graph");
                var data = [{{ $total_order_new }}, {{ $total_order_process }}, {{ $total_order_success }},
                    {{ $total_order_cancel }}
                ];
                console.log(data);
                var myChart = new Chart(pie, {
                    type: 'pie',
                    data: {
                        labels: [
                            'Đơn hàng mới',
                            'Đơn hàng đang xử lý',
                            'Đơn hàng giao thành công',
                            'Đơn hàng bị hủy'
                        ],
                        datasets: [{
                            label: 'My First Dataset',
                            data: data,
                            backgroundColor: [
                                'rgb(255, 99, 132)',
                                'rgb(54, 162, 235)',
                                'rgb(75, 192, 192)',
                                'rgb(255, 205, 86)',

                            ],
                            hoverOffset: 4
                        }]
                    }
                });
            }
        </script>
    @endpush
@endsection
