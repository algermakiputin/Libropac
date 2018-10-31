 
@extends('dashboard.dashboard-master') @section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i>Analytics</h1>
            <p>Library Analytics</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Analytics</li> 
        </ul>
    </div>
    <div class="tile">
        <h3>Barrowers</h3>
        <canvas id="bar1"></canvas> 
    </div>
</main>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.7.2/Chart.min.js"></script>
<script type="text/javascript">
  var ctx = document.getElementById('bar1').getContext('2d'); 

  // var courses = JSON.parse("{!! json_decode($course) !!}");

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
                    data: ['students'],
                },
                {
                    label: "Faculties",
                    backgroundColor: 'rgba(151,187,205,2)',
                    borderColor: 'rgba(151,187,205,1)',
                    data: ['d'],
                }
            ]

        },

        // Configuration options go here
        options: {}
    });
</script>
@endsection