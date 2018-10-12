@extends('dashboard.dashboard-master') @section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-save"></i> Librarians</h1>
            <p>Library Members</p>
        </div>
       <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
          <li class="breadcrumb-item">Librarians</li> 
        </ul>
    </div>
    <div class="tile">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered" id="librarians_table">
                    <thead>
                        <tr>
                            <th></th>
                            <th>Name</th>
                            <th>Position</th> 
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" tabindex="-1" role="dialog" id="librarians-modal">
    <div class="modal-dialog" role="document">
        <form id="librarian-update" method="POST" role="form" enctype="multipart/form-data">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Students Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 @csrf
                  <input type="hidden" name="old_image" value="" id="old_image">
                <input type="hidden" name="id" id="s_id" value="">
                 <div class="form-group row">
                  <label class="control-label col-md-3">Name</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" placeholder="Enter full name" id="name" name="name">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Position</label>
                  <div class="col-md-8">
                    <input class="form-control" type="text" id="position" placeholder="Ex. College Librarian" name="position">
                  </div>
                </div>
                <div class="form-group row">
                  <label class="control-label col-md-3">Short description</label>
                  <div class="col-md-8">
                    <textarea name="description" class="form-control" id="description" placeholder="Short description" rows="6"></textarea>
                  </div>
                </div>
                
                <div class="form-group row">
                  
                  <label class="control-label col-md-3">Upload Image</label>
                  <div class="col-md-8">
                    <img src="" id="preview">
                    <input type="file" class="form-control" id="avatar_upload" name="avatar">
                  </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary"><div class="loader"></div><span class="text">Save Changes</span></button>
                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
            </div>
        </div>
        </form>
    </div>
</div>
@endsection