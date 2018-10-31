  
   
    <meta name="csrf-token" content="{{ csrf_token() }}" /> 
    <!-- Open Graph Meta-->
   
    <title>Vali Admin - Free Bootstrap 4 Admin Template</title>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- Main CSS-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/jquery-confirm/3.3.0/jquery-confirm.min.css">
    <link rel="stylesheet" type="text/css" href="{{ url('assets/css/jquery-loading.min.css') }}">
    <link rel="stylesheet" type="text/css" href="{{ url('dashboard/css/main.css') }}">
    <!-- Font-icon css-->
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
    
    <script src="{{ url('dashboard/js/jquery-3.2.1.min.js') }}"></script>

    <script type="text/javascript">
          var base_url = {!! json_encode(url('/')) !!};
    </script>