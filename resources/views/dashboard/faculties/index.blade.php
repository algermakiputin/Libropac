@extends('dashboard.dashboard-master') @section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-save"></i> Faculties</h1>
            <p>Library Members</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Faculties</li> 
        </ul>
    </div>
    <div class="tile">
        <div class="row">
            <div class="col-md-12">
                <table class="table table-striped table-bordered" id="faculties_table">
                    <thead>
                        <tr>
                            <th>ID</th>
                            <th>Name</th>
                            <th>Gender</th>
                            <th>Position</th>
                            <th>Address</th>
                            <th>Contact</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" tabindex="-1" role="dialog" id="faculties-modal">
    <div class="modal-dialog" role="document">
        <form id="faculty-update" method="POST">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Students Information</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 
                <input type="hidden" name="id" id="s_id" value="">
                <div class="form-horizontal">
                    <div class="form-group row">
                        <label class="control-label col-md-3">Name</label>
                        <div class="col-md-8">
                            <input class="form-control" id="name" type="text" placeholder="name" name="name">
                        </div>
                    </div>
                </div>
                <div class="form-group row">
                    <label class="control-label col-md-3">Gender</label>
                    <div class="col-md-9">
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" value="male" type="radio" name="gender">Male
                            </label>
                        </div>
                        <div class="form-check">
                            <label class="form-check-label">
                                <input class="form-check-input" value="female" type="radio" name="gender">Female
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-horizontal">
                    <div class="form-group row">
                        <label class="control-label col-md-3">Position</label>
                        <div class="col-md-8">
                            <input class="form-control" id="position" type="text" name="position" placeholder="Position">
                        </div>
                    </div>
                </div>
            
                <div class="form-horizontal">
                    <div class="form-group row">
                        <label class="control-label col-md-3">Address</label>
                        <div class="col-md-8">
                            <input class="form-control" id="address" type="text" name="address" placeholder="Address">
                        </div>
                    </div>
                </div>
                <div class="form-horizontal">
                    <div class="form-group row">
                        <label class="control-label col-md-3">Contact Number</label>
                        <div class="col-md-8">
                            <input placeholder="Contact number" id="contact" class="form-control" type="text" name="contact">
                        </div>
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