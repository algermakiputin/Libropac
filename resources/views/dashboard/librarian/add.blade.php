@extends('dashboard.dashboard-master') 

@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-edit"></i> New Librarian</h1>
          <p>Library Member</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">New Librarian</li> 
        </ul>
      </div>
      <div class="tile">
      <div class="row">
       
        <div class="offset-md-3 col-md-6">
            <h3 class="tile-title">New Librarian Form</h3>
            <p>Librarians will be shown in the home page.</p>
            <div class="tile-body">
              <form class="form-horizontal" id="librarian_form" action="{{ url('admin/librarian/store') }}" enctype="multipart/form-data" method="POST">
              @csrf
                <div class="form-group row">
                  <label class="control-label col-md-3">Name</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" required="required" placeholder="Enter full name" name="name">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Position</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" required="required" placeholder="Ex. College Librarian" name="position">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Short description</label>
                  <div class="col-md-8">
                    <textarea name="description" class="form-control" required="required" placeholder="Short description" rows="6"></textarea>
                  </div>
                </div>
                
                <div class="form-group row">
                  
                  <label class="control-label col-md-3">Upload Image</label>
                  <div class="col-md-8">
                    <img src="" id="preview">
                    <input type="file" required="required" class="form-control" id="avatar_upload" name="avatar">
                  </div>
                </div>
                 <div class="tile-footer">
              <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Register</button>&nbsp;&nbsp;&nbsp;<a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a>
                </div>
              </div>
            </div>
              </form>
            </div>
            
          </div>
        </div>
        <div class="clearix"></div>
     
      </div>
    </main>
@endsection