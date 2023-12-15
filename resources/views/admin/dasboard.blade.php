@extends('admin.layouts.app')
@section('contents')
<div style="margin-top:50px">
        <div class="row" style="margin-bottom: 50px" style="display: flex">
            <form action="" method="get" class="form-create"style = "display:flex;justify-content:center;align-items:center;padding-left:212px" >
                @csrf
                <div style="width: 30%">
                    <label for="date_from">Date From</label>
                    <input type="date" value="" class="form-control" name="date_from" style="border: 1px solid; width:30%">
                </div>
                <div style="width: 30%" >
                    <label for="date_to">Date To</label>
                    <input type="date" value="" class="form-control" name="date_to" style="border: 1px solid ; width:30%">
                </div>
                <div style="width: 30%">
                    <button type="submit" class="submit-date bg-gradient-success" data-url = {{route('admin.dashboard.index')}}>submit</button>
                </div>
            </form>
        </div>
        <div class="row" style="justify-content: center">
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-dark shadow-dark text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">weekend</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Tổng sản phẩm</p>
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
                            <p class="text-sm mb-0 text-capitalize">Tổng người dùng</p>
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
            <div class="col-xl-3 col-sm-6 mb-xl-0 mb-4">
                <div class="card">
                    <div class="card-header p-3 pt-2">
                        <div
                            class="icon icon-lg icon-shape bg-gradient-success shadow-success text-center border-radius-xl mt-n4 position-absolute">
                            <i class="material-icons opacity-10">person</i>
                        </div>
                        <div class="text-end pt-1">
                            <p class="text-sm mb-0 text-capitalize">Tổng danh mục</p>
                            <h4 class="mb-0">{{ $total_category }}</h4>
                        </div>
                    </div>
                    <hr class="dark horizontal my-0">
                    <div class="card-footer p-3">
                       
                    </div>
                </div>
            </div>
        </div>
        
    </div>
    <div class="card mb-3" style="width: 50%;margin-top:40px;margin-left:40px">
        <div class="card-body p-3">
          <div class="chart">
            <canvas id="bar-chart" class="chart-canvas" height="300px"></canvas>
          </div>
        </div>
      </div>

    <div id="chart-container" style="width: 366px;height:300px;margin-left:16%;margin-top:25px">
        <canvas id="graph"></canvas>
    </div>

    @push('page_script')
        <script type="module">
            var data = {!! json_encode($dataForChart) !!};
            var ctx = document.getElementById('bar-chart').getContext('2d');
            var myBarChart = new Chart(ctx, {
                type: 'bar',
                data: {
                    labels: data.labels,
                    datasets: [{
                        label: 'Tổng tiền theo ngày đặt hàng',
                        data: data.data,
                        backgroundColor: ['rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 205, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(201, 203, 207, 0.2)'],
                        borderColor: ['rgba(255, 99, 132, 0.2)',
                                    'rgba(255, 159, 64, 0.2)',
                                    'rgba(255, 205, 86, 0.2)',
                                    'rgba(75, 192, 192, 0.2)',
                                    'rgba(54, 162, 235, 0.2)',
                                    'rgba(153, 102, 255, 0.2)',
                                    'rgba(201, 203, 207, 0.2)'],
                        borderWidth: 1
                    }]
                },
                options: {
                    scales: {
                        y: {
                            beginAtZero: true
                        }
                    }
                }
            });

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
