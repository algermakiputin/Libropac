@extends('dashboard.dashboard-master') 

@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-user"></i> My Profile</h1>
          <p>Library Staff</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Forms</li>
          <li class="breadcrumb-item"><a href="#">Sample Forms</a></li>
        </ul>
      </div>
      <div class="tile">
      <div class="row">
       
        <div class="offset-md-3 col-md-6"> 
            <div class="tile-body">
              <h3 class="tile-title">My Profile</h3>
              <form class="form-horizontal" id="profile" enctype="multipart/form-data" method="POST">
              @csrf
                <div class="form-group row">
                  
                  <label class="control-label col-md-3" id="upload_label">Avatar</label>
                  <div class="col-md-8">
                    <img src="{{ url('storage/avatar') . '/' . $data->avatar }}" id="preview" style="display: block !important;">
                    <input type="file" class="form-control" id="avatar_upload" name="avatar" style="display: none;">
                  </div>
                </div>
                <div class="form-group row">
                  <input type="hidden" name="id" value="{{ $data->id }}">
                  <label class="control-label col-md-3">Name</label>
                  <div class="col-md-8">
                    <input disabled="disabled" class="form-control" type="text" placeholder="Enter full name" name="name" value="{{ $data->name}}">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Email</label>
                  <div class="col-md-8">
                    <input class="form-control" disabled="disabled" value="{{ $data->email}}" type="email" placeholder="Email" name="email">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Role</label>
                  <div class="col-md-8">
                    <select name="role" class="form-control" disabled="disabled" name="role">
                        <option value="">Select Role</option>
                        <option value="staff" {{ $data->role == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="admin" {{ $data->role == 'admin' ? 'selected' : '' }}>Admin</option>
                    </select>
                  </div>
                </div>
                
                
                 <div class="tile-footer">
              <div class="row">
                <div class="col-md-8 col-md-offset-3">
                  <button class="btn btn-primary" disabled="disabled" type="submit" ><i class="fa fa-fw fa-lg fa-check-circle"></i>Update</button>&nbsp;&nbsp;&nbsp;<a id="user-edit" class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-edit"></i>Edit</a>
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