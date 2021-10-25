@extends('backend.master.template')
@section('content')
<div class="main">
    <main class="content">
        <div class="container-fluid">

            <div class="header col-md-12"  style="display: inline-flex">
                <div class="col-md-9">
                    <h1 class="header-title">
                        Dashboard - Monthly Summary ( <span id="today">{{ date('F', strtotime($startDate))  }}</span> ) 
                    </h1>
                    <p class="header-subtitle">Summary of Monthly Performance.</p>          
                </div>

                <div class="col-md-3">
                    <select class="form-control" id="filtering_month"  name="filtering_month" placeholder="Choose Month">
                        <option selected disabled>Select a Month</option>
                        <option value="1">January</option>
                        <option value="2">February</option>
                        <option value="3">March</option>
                        <option value="4">April</option>
                        <option value="5">May</option>
                        <option value="6">June</option>
                        <option value="7">July</option>
                        <option value="8">August</option>
                        <option value="9">September</option>
                        <option value="10">October</option>
                        <option value="11">November</option>
                        <option value="12">December</option>
                    </select>
                </div>
            </div>

            <div class="row">
                <div class="col-12 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-md-6 col-lg-3 col-xl">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Net Income</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="avatar">
                                                    <div class="avatar-title rounded-circle bg-primary-dark">
                                                        <i class="align-middle fas fa-money-bill-wave"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="display-5 mt-1 mb-3">₱{{ number_format($monthly - $expense, 2) }}</h1>
                                        <div class="mb-0">
                                            <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i> 5.50% </span> More Net Income than usual
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xl">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Average Sales</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="avatar">
                                                    <div class="avatar-title rounded-circle bg-primary-dark">
                                                        <i class="fas fa-chart-bar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="display-5 mt-1 mb-3">₱{{ number_format($average, 2) }}</h1>
                                        <div class="mb-0">
                                            <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> -4.25% </span> Less Average Sale than usual
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-md-6 col-lg-3 col-xl">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">GCash</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="avatar">
                                                    <div class="avatar-title rounded-circle bg-primary-dark">
                                                        <i class="fas fa-chart-bar"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="display-5 mt-1 mb-3">₱{{ number_format($gcash, 2) }}</h1>
                                        <div class="mb-0">
                                            GCash Money
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-6 col-lg-3 col-xl">
                                <div class="card">
                                    <div class="card-body">
                                        <div class="row">
                                            <div class="col mt-0">
                                                <h5 class="card-title">Cash</h5>
                                            </div>

                                            <div class="col-auto">
                                                <div class="avatar">
                                                    <div class="avatar-title rounded-circle bg-primary-dark">
                                                        <i class="align-middle fas fa-money-bill-wave"></i>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <h1 class="display-5 mt-1 mb-3">₱{{ number_format($cash, 2) }}</h1>
                                        <div class="mb-0">
                                            Cash Money
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-12 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-sm-12 col-md-12 col-lg-12 col-xxl-12">
                                <div class="card flex-fill w-100">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Monthly Sales</h5>
                                    </div>
                                    <div class="card-body d-flex w-100">
                                        <div class="align-self-center chart chart-lg">
                                            <canvas id="chartjs-dashboard-bar"></canvas>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-xl-12 col-xxl-12 d-flex">
                    <div class="w-100">
                        <div class="row">
                            <div class="col-12 col-sm-12 col-md-12 col-lg-12 col-xxl-12 d-flex">
                                <div class="card flex-fill" style="padding: 15px">
                                    <div class="card-header">
                                        <h5 class="card-title mb-0">Daily Sales Summary</h5>
                                    </div>
                                    <table id="datatables" class="table table-striped my-0" >
                                        <thead>
                                            <tr>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Total</th>
                                                <th width="80px">Sales Performance</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                           @foreach ($daily_sales as $key => $daily_sale)
                                            <tr>
                                                <td>{{ ++$key }}</td>
                                                <td>{{ date('M-d-Y', strtotime($daily_sale->date))}}</td>
                                                <td> ₱{{number_format($daily_sale->total, 2)}} </td>
                                                @if (($daily_sale->total/10000) * 100 >= 100)
                                                    <td> <span class="badge badge-success">{{ ($daily_sale->total/10000) * 100 }}%</span></td>
                                                @else
                                                    <td> <span class="badge badge-danger">{{ ($daily_sale->total/10000) * 100 }}%</span></td>
                                                @endif
                                            </tr>
                                           @endforeach
                                            
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
</div>
@endsection

@section('scripts')
                

    <script>
       $(function() {
        // PIE CHART
        $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/dashboard/piechart',
                method: 'get',
                success: function(data) {
                    var expense_type = [];
                    var amount = [];
                    var color = [];

                    for(i=0; i < data.piechart.length; i++) {
                        expense_type.push(data.piechart[i].expense_type.expense);
                        amount.push(data.piechart[i].amount);
                        color.push(data.piechart[i].expense_type.color);
                    }
                    // Pie chart
                    new Chart(document.getElementById("chartjs-dashboard-pie"), {
                        type: 'pie',
                        data: {
                            labels: expense_type,
                            datasets: [{
                                data: amount,
                                backgroundColor: color,
                                borderColor: "transparent"
                            }]
                        },
                        options: {
                            responsive: !window.MSInputMethodContext,
                            maintainAspectRatio: false,
                            legend: {
                                display: false
                            },
                            cutoutPercentage: 75
                        }
                    });
                }
            });

            $('#datatables').DataTable({
                responsive: true,
                "pageLength": 100
            });

            $('#filtering_date').change(function(){
                $('#datatables').dataTable().fnDestroy();

                $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/dashboard/filtering/' + this.value,
                method: 'get',
                success: function(data) {
                    var formatter = new Intl.NumberFormat('en-PH', {
                    style: 'currency',
                    currency: 'PHP',
                    });

                    $('#total_sale').text(formatter.format(data.daily_sale));
                    $('#total_expense').text(formatter.format(data.expense));
                    $('#bdo').text(formatter.format(data.bdo));
                    $('#bpi').text(formatter.format(data.bpi));
                    $('#gcash').text(formatter.format(data.gcash));
                    $('#cash').text(formatter.format(data.cash));
                    $('#today').text(moment(data.dt).format('MMM-DD-YYYY'));

                    $('#datatables').DataTable({
                        processing: true,
                        serverSide: true,
                        ajax: {
                        url: "/dashboard/payment/" + data.dt,
                        type: 'GET',
                        },
                        columns: [
                                {data: 'DT_RowIndex', name: 'DT_RowIndex'},
                                {data: 'dailysale.customer.name', name: 'dailysale.customer.name' },
                                {data: 'amount', name: 'amount' },
                                {data: 'payment_type.payment', name: 'payment_type.payment' },
                            ],
                        order: [[0, 'desc']]
                    });
                }
            });
            })

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/dashboard/bargraph',
                method: 'get',
                success: function(data) {
                    var payment = [];
                    var daily = [];

                    console.log(data);
                    for(i=0; i < data.bargraph.length; i++) {
                        payment.push(data.bargraph[i].total);
                        daily.push(moment(data.bargraph[i].date).format('MMM-DD'));
                    }
                   
                    // BAR GRAPH
                    new Chart(document.getElementById("chartjs-dashboard-bar"), {
                    type: 'bar',
                    data: {
                        labels: daily,
                        datasets: [{
                            label: "This Day",
                            backgroundColor: window.theme.primary,
                            borderColor: window.theme.primary,
                            hoverBackgroundColor: window.theme.primary,
                            hoverBorderColor: window.theme.primary,
                            data: payment,
                            barPercentage: .75,
                            categoryPercentage: .5
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    display: false
                                },
                                stacked: false,
                                ticks: {
                                    stepSize: 1000
                                }
                            }],
                            xAxes: [{
                                stacked: false,
                                gridLines: {
                                    color: "transparent"
                                }
                            }]
                        }
                    }
                });
                  
                }
            });


            // BAR GRAPH EXPENSE

            $.ajax({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                url: '/dashboard/bargraph_expense',
                method: 'get',
                success: function(data) {
                    var payment = [];
                    var daily = [];

                    console.log(data);
                    for(i=0; i < data.bargraph.length; i++) {
                        payment.push(data.bargraph[i].total);
                        daily.push(moment(data.bargraph[i].date).format('MMM-DD'));
                    }
                   
                    // BAR GRAPH
                    new Chart(document.getElementById("bar-graph-expense"), {
                    type: 'bar',
                    data: {
                        labels: daily,
                        datasets: [{
                            label: "This Day",
                            backgroundColor: window.theme.danger,
                            borderColor: window.theme.danger,
                            hoverBackgroundColor: window.theme.danger,
                            hoverBorderColor: window.theme.danger,
                            data: payment,
                            barPercentage: .75,
                            categoryPercentage: .5
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        },
                        scales: {
                            yAxes: [{
                                gridLines: {
                                    display: false
                                },
                                stacked: false,
                                ticks: {
                                    stepSize: 1000
                                }
                            }],
                            xAxes: [{
                                stacked: false,
                                gridLines: {
                                    color: "transparent"
                                }
                            }]
                        }
                    }
                });
                  
                }
            });
            
            // CALENDAR
            $('#datetimepicker-dashboard').datetimepicker({
				inline: true,
				sideBySide: false,
				format: 'L'
            });
        });
    </script>
@endsection