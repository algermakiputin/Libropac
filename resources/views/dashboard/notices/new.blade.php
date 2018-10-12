@extends('dashboard.dashboard-master') @section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i>Add Books</h1>
            <p>Library Holdings</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item"><a href="#">Sample Forms</a></li>
        </ul>
    </div>
    <div class="tile">
        <form method="POST" action="{{ url('admin/notices/store') }}" id="new_notice">
          @csrf
          <div class="row">
            
              <div class="offset-md-2 col-md-8">

                  <div class="tile-body">
                      <div class="form-horizontal">
                          <h3 class="tile-title">Add new library notice</h3>
                         
                          <div class="form-group row">
                              <label class="control-label col-md-3">Title</label>
                              <div class="col-md-8">
                                  <input class="form-control" required="required" type="text" placeholder="Title" name="title">
                              </div>
                          </div>
                          
                          <div class="form-group row">
                              <label class="control-label col-md-3">Content</label>
                              <div class="col-md-8">
                                  <textarea class="form-control" required="required" type="text" placeholder="Content" name="content" rows="7"></textarea>
                              </div>
                          </div>

                      </div>
                  </div>

              </div>
              
              <div class="offset-md-2 col-md-8 ">
                  <div class="tile-footer">
                      <a class="btn btn-secondary" href="#"><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a> &nbsp;&nbsp;&nbsp;
                      <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                  </div>
              </div>
              <div class="clearix"></div>
              
          </div>
        </form>
    </div>
</main>
@endsection