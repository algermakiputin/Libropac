@extends('dashboard.dashboard-master') @section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-save"></i> Users</h1>
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
            <div class="col-md-12">
                <table class="table table-striped table-bordered" id="users_table">
                    <thead>
                        <tr> 
                            <th>Name</th>
                            <th>Email</th>
                            <th>Role</th> 
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" tabindex="-1" role="dialog" id="user-register">
    <div class="modal-dialog" role="document">
        <form id="registerUser" method="POST">
          <div class="modal-content">
              <div class="modal-header">
                  <h5 class="modal-title">Add User</h5>
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                      <span aria-hidden="true">&times;</span>
                  </button>
              </div>
              <div class="modal-body"> 
                   <div class="form-group row">
                    <label class="control-label col-md-3">Name</label>
                    <div class="col-md-8">
                      <input class="form-control" required="required" id="r_name" type="text" placeholder="Enter full name" name="name">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3">Email</label>
                    <div class="col-md-8">
                      <input class="form-control" required="required" id="r_email" type="email" placeholder="Email" name="email">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3">Role</label>
                    <div class="col-md-8">
                      <select name="role" class="form-control" id="r_role" required="required">
                          <option value="">Select Role</option>
                          <option value="staff">Staff</option>
                          <option value="admin">Admin</option>
                      </select>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3" required="required">Password</label>
                    <div class="col-md-8">
                      <input class="form-control" type="password" placeholder="Password" name="password" id="password">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label class="control-label col-md-3" required="required" >Confirm Password</label>
                    <div class="col-md-8">
                      <input class="form-control" type="password" data-parsley-equalto="#password" placeholder="Confirm Passowrd" name="confirm_password">
                    </div>
                  </div>
                  <div class="form-group row">
                    
                    <label class="control-label col-md-3">Upload Avatar</label>
                    <div class="col-md-8">
                      <img src="" id="preview">
                      <input type="file" class="form-control" required="required" id="avatar_upload" name="avatar">
                    </div>
                  </div>
                  
              </div>
              <div class="modal-footer">
                  <button type="submit" class="btn btn-primary"><div class="loader"></div><span class="text">Register</span></button>
                  <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              </div>
          </div>
        </form>
    </div>
</div>

<div class="modal fade" tabindex="-1" role="dialog" id="user-update">
    <div class="modal-dialog" role="document">
        <form id="update-user" method="POST"> 
        @csrf 
        @method('post')
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Edit User</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 <input type="hidden" name="id" id="u_id">
                 <input type="hidden" name="old_image" id="old_image">
                 <div class="form-group row">
                  <label class="control-label col-md-3">Avatar</label>
                  <div class="col-md-8">
                    <img src="" id="avatar">
                     
                  </div>
                </div>
                 <div class="form-group row">
                  <label class="control-label col-md-3">Name</label>
                  <div class="col-md-8">
                    <input class="form-control" disabled="disabled" type="text" placeholder="Enter full name" name="name">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Email</label>
                  <div class="col-md-8">
                    <input class="form-control" disabled="disabled" type="email" placeholder="Email" name="email">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Role</label>
                  <div class="col-md-8">
                    <select name="role" class="form-control">
                        <option value="">Select Role</option>
                        <option value="staff">Staff</option>
                        <option value="admin">Admin</option>
                    </select>
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Password <small></small></label>
                  <div class="col-md-8">
                    <input class="form-control" type="password" disabled="disabled" placeholder="Password" name="password">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Confirm Password</label>
                  <div class="col-md-8">
                    <input class="form-control" type="password" disabled="disabled" placeholder="Confirm Passowrd" name="confirm_password">
                  </div>
                </div>
                
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><div class="loader"></div><span class="text">Update</span></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection