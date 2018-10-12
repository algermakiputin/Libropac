@extends('dashboard.dashboard-master') @section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-save"></i> Medias</h1>
            <p>Library Holdings</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Media</li> 
        </ul>
    </div>
    <div class="tile">
        <div class="row">
          <div class="col-md-12"> 
            <table class="table table-striped table-bordered" id="media_table">
            <thead>
              <tr >
                <th>Accession No.</th>
                <th>Title</th>
                <th>Author</th>
                <th>Type</th>
                <th>Source of Fund</th>
                <th>Price</th>
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