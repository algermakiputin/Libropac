@extends('dashboard.dashboard-master') @section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i>Books</h1>
            <p>Library Holdings</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Books</li> 
        </ul>
    </div>
    <div class="tile">
        <div class="row">
          <div class="col-md-12"> 
            <table class="table table-striped table-bordered" id="books_table">
            <thead>
              <tr >
                <th><div>Location Symbol</div></th>
                <th>Class No.</th>
                <th>Book Title</th>
                <th>Author 1</th>
                <th>Subject Code</th>
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