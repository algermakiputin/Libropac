@extends('dashboard.dashboard-master') @section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-save"></i> Notice</h1>
            <p>Library Notices</p>
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
                <table class="table table-striped table-bordered" id="notices_table">
                    <thead>
                        <tr> 
                            <th>Created at</th>
                            <th>Title</th>   
                            <th>Content</th>
                            <th>Actions</th>
                        </tr>
                    </thead>
                </table>
            </div>
        </div>
    </div>
</main>

<div class="modal fade" tabindex="-1" role="dialog" id="notices-modal">
    <div class="modal-dialog" role="document">
        <form id="notice-update" method="POST">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title">Update Notice</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                 
                <input type="hidden" name="id" id="s_id" value="">
                <div class="form-horizontal">
                    <div class="form-group row">
                        <label class="control-label col-md-2">Title</label>
                        <div class="col-md-10">
                            <input class="form-control" id="title" type="text" placeholder="Title" name="title">
                        </div>
                    </div>
                </div>
               
                 
                <div class="form-horizontal">
                    <div class="form-group row">
                        <label class="control-label col-md-2">Content</label>
                        <div class="col-md-10">
                            <textarea rows="7" id="content" name="content" class="form-control"></textarea>
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