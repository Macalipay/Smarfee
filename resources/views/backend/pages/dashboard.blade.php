@extends('backend.master.template')
@section('content')
<main class="content">
    <div class="container-fluid">

        <div class="header">
            <h1 class="header-title">
               Dashboard
            </h1>
            <p class="header-subtitle"> Transaction Management Overview.</p>
        </div>

        <div class="row">
            <div class="col-xl-6 col-xxl-5 d-flex">
                <div class="w-100">
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Net Profit</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="avatar">
                                                <div class="avatar-title rounded-circle bg-primary-dark">
                                                    <i class="align-middle" data-feather="users"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="display-5 mt-2 mb-4">₱ 80,342</h1>
                                    <div class="mb-0">
                                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i> </span> Total Net Profit.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Gross Income</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="avatar">
                                                <div class="avatar-title rounded-circle bg-primary-dark">
                                                    <i class="align-middle" data-feather="activity"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="display-5 mt-2 mb-4">₱ 150,000</h1>
                                    <div class="mb-0">
                                        <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i>  </span> Total Income.
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Order</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="avatar">
                                                <div class="avatar-title rounded-circle bg-primary-dark">
                                                    <i class="align-middle" data-feather="external-link"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="display-5 mt-2 mb-4">650</h1>
                                    <div class="mb-0">
                                        <span class="text-success"> <i class="mdi mdi-arrow-bottom-right"></i></span> Total Transaction.
                                    </div>
                                </div>
                            </div>
                            <div class="card">
                                <div class="card-body">
                                    <div class="row">
                                        <div class="col mt-0">
                                            <h5 class="card-title">Expense</h5>
                                        </div>

                                        <div class="col-auto">
                                            <div class="avatar">
                                                <div class="avatar-title rounded-circle bg-primary-dark">
                                                    <i class="align-middle" data-feather="shopping-cart"></i>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <h1 class="display-5 mt-2 mb-4">₱ 69,658</h1>
                                    <div class="mb-0">
                                        <span class="text-danger"> <i class="mdi mdi-arrow-bottom-right"></i>  </span> Total Expense.
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col-xl-6 col-xxl-7 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <div class="card-actions float-right">
                            <a href="#" class="mr-1">
                                <i class="align-middle" data-feather="refresh-cw"></i>
                            </a>
                            <div class="d-inline-block dropdown show">
                                <a href="#" data-toggle="dropdown" data-display="static">
                            <i class="align-middle" data-feather="more-vertical"></i>
                            </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h5 class="card-title mb-0">Order Summary</h5>
                    </div>
                    <table class="table table-striped my-0">
                        <thead>
                            <tr>
                                <th>Status</th>
                                <th class="text-right">Order Count </th>
                                <th class="d-none d-xl-table-cell w-75">% Order Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Success Transaction</td>
                                <td class="text-right">554</td>
                                <td class="d-none d-xl-table-cell">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary-dark" role="progressbar" style="width: 43%;" aria-valuenow="43" aria-valuemin="0" aria-valuemax="100">43%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>Cancelled Transaction</td>
                                <td class="text-right">350</td>
                                <td class="d-none d-xl-table-cell">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary-dark" role="progressbar" style="width: 27%;" aria-valuenow="27" aria-valuemin="0" aria-valuemax="100">27%</div>
                                    </div>
                                </td>
                            </tr>
                            <tr>
                                <td>On-going Transaction</td>
                                <td class="text-right">438</td>
                                <td class="d-none d-xl-table-cell">
                                    <div class="progress">
                                        <div class="progress-bar bg-primary-dark" role="progressbar" style="width: 22%;" aria-valuenow="22" aria-valuemin="0" aria-valuemax="100">22%</div>
                                    </div>
                                </td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col-12 col-lg-7 col-xl-8 d-flex">
                <div class="card flex-fill">
                    <div class="card-header">
                        <div class="card-actions float-right">
                            <a href="#" class="mr-1">
                                <i class="align-middle" data-feather="refresh-cw"></i>
                            </a>
                            <div class="d-inline-block dropdown show">
                                <a href="#" data-toggle="dropdown" data-display="static">
                                    <i class="align-middle" data-feather="more-vertical"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h5 class="card-title mb-0">Active Order</h5>
                    </div>
                    <table id="datatables-dashboard-traffic" class="table table-striped my-0">
                        <thead>
                            <tr>
                                <th>Customer Name</th>
                                <th class="text-right">Order</th>
                                <th class="d-none d-xl-table-cell text-right">Total Amount</th>
                                <th class="d-none d-xl-table-cell text-right">Contact #</th>
                                <th class="d-none d-xl-table-cell text-right">Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr>
                                <td>Geaven Cruz</td>
                                <td class="text-right">1 Coffee</td>
                                <td class="d-none d-xl-table-cell text-right">₱ 58</td>
                                <td class="d-none d-xl-table-cell text-right">0975390235</td>
                                <td class="d-none d-xl-table-cell text-right text-success">Completed</td>
                            </tr>
                            <tr>
                                <td>Jerry Ang</td>
                                <td class="text-right">3 Coffee</td>
                                <td class="d-none d-xl-table-cell text-right">₱ 358</td>
                                <td class="d-none d-xl-table-cell text-right">0945390235</td>
                                <td class="d-none d-xl-table-cell text-right text-warning">On Process</td>
                            </tr>
                            <tr>
                                <td>Abby Samuel</td>
                                <td class="text-right">7 coffee</td>
                                <td class="d-none d-xl-table-cell text-right">₱ 658</td>
                                <td class="d-none d-xl-table-cell text-right">0944290554</td>
                                <td class="d-none d-xl-table-cell text-right text-danger">Cancelled</td>
                            </tr>
                            <tr>
                                <td>John Borja</td>
                                <td class="text-right">8 brewed Coffee</td>
                                <td class="d-none d-xl-table-cell text-right">₱ 258</td>
                                <td class="d-none d-xl-table-cell text-right">09856423854</td>
                                <td class="d-none d-xl-table-cell text-right text-success">Completed</td>
                            </tr>
                            <tr>
                                <td>Michael Tray</td>
                                <td class="text-right">3 coffee</td>
                                <td class="d-none d-xl-table-cell text-right">₱ 88</td>
                                <td class="d-none d-xl-table-cell text-right">094417756825</td>
                                <td class="d-none d-xl-table-cell text-right text-success">Completed</td>
                            </tr>
                            <tr>
                                <td>Gilbert Bel</td>
                                <td class="text-right">8 pcs coffee</td>
                                <td class="d-none d-xl-table-cell text-right">₱ 558</td>
                                <td class="d-none d-xl-table-cell text-right">094417756825</td>
                                <td class="d-none d-xl-table-cell text-right text-danger">Hold</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
            <div class="col-12 col-lg-5 col-xl-4 d-flex">
                <div class="card flex-fill w-100">
                    <div class="card-header">
                        <div class="card-actions float-right">
                            <a href="#" class="mr-1">
                                <i class="align-middle" data-feather="refresh-cw"></i>
                            </a>
                            <div class="d-inline-block dropdown show">
                                <a href="#" data-toggle="dropdown" data-display="static">
                                    <i class="align-middle" data-feather="more-vertical"></i>
                                </a>

                                <div class="dropdown-menu dropdown-menu-right">
                                    <a class="dropdown-item" href="#">Action</a>
                                    <a class="dropdown-item" href="#">Another action</a>
                                    <a class="dropdown-item" href="#">Something else here</a>
                                </div>
                            </div>
                        </div>
                        <h5 class="card-title mb-0">Summary of Review/Rating</h5>
                    </div>
                    <div class="card-body d-flex">
                        <div class="align-self-center w-100">
                            <div class="py-3">
                                <div class="chart chart-xs">
                                    <canvas id="chartjs-dashboard-pie"></canvas>
                                </div>
                            </div>

                            <table class="table mb-0">
                                <tbody>
                                    <tr>
                                        <td><i class="fas fa-circle text-primary fa-fw"></i> Positive Comment (3 star)</td>
                                        <td class="text-right">45</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-circle text-warning fa-fw"></i> Negative Comment (2 star)</td>
                                        <td class="text-right">32</td>
                                    </tr>
                                    <tr>
                                        <td><i class="fas fa-circle text-danger fa-fw"></i>No Feedback</td>
                                        <td class="text-right">63</td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </div>

    </div>
</main>
@endsection

@section('scripts')
        <script>
            $(function() {
                // Pie chart
                new Chart(document.getElementById("chartjs-dashboard-pie"), {
                    type: 'pie',
                    data: {
                        labels: ["Chrome", "Firefox", "IE", "Other"],
                        datasets: [{
                            data: [4401, 4003, 1589],
                            backgroundColor: [
                                window.theme.primary,
                                window.theme.warning,
                                window.theme.danger,
                                "#E8EAED"
                            ],
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
            });
        </script>
        <script>
            $(function() {
                // Radar chart
                new Chart(document.getElementById("chartjs-dashboard-radar"), {
                    type: "radar",
                    data: {
                        labels: ["Birth Request", "Death Request", "Marriage Request", "Birth Application", "Death Application", "Marriage Application"],
                        datasets: [{
                            label: "Process",
                            backgroundColor: "rgba(0, 123, 255, 0.2)",
                            borderColor: "#2979ff",
                            pointBackgroundColor: "#2979ff",
                            pointBorderColor: "#fff",
                            pointHoverBackgroundColor: "#fff",
                            pointHoverBorderColor: "#2979ff",
                            data: [70, 53, 82, 60, 33, 55]
                        }]
                    },
                    options: {
                        maintainAspectRatio: false,
                        legend: {
                            display: false
                        }
                    }
                });
            });
        </script>
        <script>
            $(function() {
                // Bar chart
                new Chart(document.getElementById("chartjs-dashboard-bar-alt"), {
                    type: "bar",
                    data: {
                        labels: ["Jan", "Feb", "Mar", "Apr", "May"],
                        datasets: [{
                            label: "Last year",
                            backgroundColor: window.theme.primary,
                            borderColor: window.theme.primary,
                            hoverBackgroundColor: window.theme.primary,
                            hoverBorderColor: window.theme.primary,
                            data: [54, 67, 41, 55, 62, 45],
                            barPercentage: .75,
                            categoryPercentage: .5
                        }, {
                            label: "This year",
                            backgroundColor: "#E8EAED",
                            borderColor: "#E8EAED",
                            hoverBackgroundColor: "#E8EAED",
                            hoverBorderColor: "#E8EAED",
                            data: [69, 66, 24, 48, 52, 51],
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
                                    stepSize: 20
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
            });
        </script>
        <script>
            $(function() {
                $("#datatables-dashboard-traffic").DataTable({
                    pageLength: 7,
                    lengthChange: false,
                    bFilter: false,
                    autoWidth: false,
                    order: [
                        [1, "desc"]
                    ]
                });
            });
    </script>
@endsection
