@extends('dashboard.dashboard-master') @section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-exchange"></i> Transactions</h1>
            <p>Library records</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Transactions</li> 
        </ul>
    </div>
    <div class="tile">
        <div class="row">
          <div class="col-md-12"> 
            <table class="table table-striped table-bordered" id="transactions_table">
            <thead>
              <tr >
                <th></th>
                <th>ID</th>
                <th>Barrow Date</th>
                <th>Name</th>
                <th>Membership</th>
                <th>Barrow</th>
                <th>Title</th>
                <th>Status</th>
                <th>Actions</th>
              </tr>
            </thead>
          </table>
          </div>
        </div>
    </div>
</main>
@endsection