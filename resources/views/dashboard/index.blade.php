@extends('dashboard.dashboard-master') 
@section('content')

<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-dashboard"></i> Dashboard</h1>
            <p>Library Management System</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item"><a href="#">Dashboard </a></li>
        </ul>
    </div>
    @if (Session()->has('success'))
        <div class="row">
        <div class="col-md-12">
            <div class="alert alert-success">
                <b>Message</b> Login Successful, Welcome! {{ Auth()->user()->name }}
            </div>
        </div>
    </div>
    @endif
    <div class="row">
        <div class="col-md-3">
            <div class="widget-small primary coloured-icon">
                <div class="info">
                    <h4>{{ $widget[0] }}</h4>
                    <p><b>Total Members</b></p>
                </div>
                <i class="icon fa fa-users fa-3x"></i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="widget-small primary coloured-icon">
                <div class="info">
                    <h4>{{ $widget[1] }}</h4>
                    <p><b>Total Books</b></p>
                </div>
                <i class="icon fa fa-book fa-3x"></i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="widget-small primary coloured-icon">
                <div class="info">
                    <h4>{{ $widget[2] }}</h4>
                    <p><b>Total Medias</b></p>
                </div>
                <i class="icon fa fa-save fa-3x"></i>
            </div>
        </div>
        <div class="col-md-3">
            <div class="widget-small primary coloured-icon">
                <div class="info">
                    <h4>{{ $widget[3] }}</h4>
                    <p><b>Total Transactions</b></p>
                </div>
                <i class="icon fa fa-exchange fa-3x"></i>
            </div>
        </div>

    </div>
    <div class="row">
        <div class="col-md-8">
            <div class="tile">
                <h3 class="tile-title">Monthly Transactions</h3>
                <div class="">
                    <!-- <canvas class="embed-responsive-item" id="lineChartDemo"></canvas> -->
                    <canvas id="myChart"></canvas>
                </div>
            </div>
        </div>
        <div class="col-md-4">
            <div class="tile">
                <h3 class="tile-title">Transaction Status</h3>
                <div class="">
                    <canvas class="embed-responsive-item" id="pie"></canvas>
                </div>
            </div>
        </div>
    </div>
    
</main>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<script type="text/javascript">
    var ctx = document.getElementById('myChart').getContext('2d');
    var ctxp = document.getElementById('pie').getContext('2d');
    var students = JSON.parse("{{ json_encode($students) }}");
    var faculties = JSON.parse("{{ json_encode($faculties) }}");
    var chart = new Chart(ctx, {
        // The type of chart we want to create
        type: 'bar',

        // The data for our dataset
        data: {
            labels: ["January", "February", "March", "April", "May", "June", "July", "Auguest", "September","October", "November", "December"],
            datasets: [
                {
                    label: "Students",
                    backgroundColor: 'rgba(220,220,220,2)',
                    borderColor: 'rgba(220,220,220,1)',
                    data: students,
                },
                {
                    label: "Faculties",
                    backgroundColor: 'rgba(151,187,205,2)',
                    borderColor: 'rgba(151,187,205,1)',
                    data: faculties,
                }
            ]

        },

        // Configuration options go here
        options: {}
    });

    var data = {
        labels: ["Complete ", "Pending", "Lost"],
          datasets: [
            {
                fill: true,
                backgroundColor: [
                    '#009688',
                    '#17a2b8',
                    '#F7464A'
                    ],
                data: ['{{ $complete }}','{{ $pending }}','{{ $lost }}'],
 
                borderColor:    ['#fff'],
                
            }
        ]
    };
 

    var myPieChart = new Chart(ctxp,{
        type: 'pie',
        data: data, 
    });
</script>
 
@endcontent @endsection