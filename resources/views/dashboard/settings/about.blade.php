@extends('dashboard.dashboard-master') @section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-cog"></i> Settings</h1>
            <p>About Library Department</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">About</li> 
        </ul>
    </div>
    <div class="tile">
        <form method="POST" id="settings" action="{{ url('admin/settings/about-store') }}">
          @csrf 
          <div class="row">
              <div class="  col-md-12 ">
                  @if (Session::has('success'))
                  <div class="alert alert-success">
                       {{ Session::get('success') }}
                    </div>
                    @endif
                  
              </div>
              <div class=" col-md-12">
                  <div class="tile-body">
                      <h3 class="tile-title">About Library Department</h3>
                      <p><i class="fa fa-info-circle"></i> The content here will appear in the home page.</p>
                      <div class="form-group">
                          <label class="control-label">Tag Line</label>
                          <input type="text" id="tag-line" name="tag-line" class="form-control" value="{{ $exist ? $about->tag_line : '' }}" {{ $exist ? 'disabled' : '' }}>  
                      </div>
                      <div class="form-group">
                          <label class="control-label">Content</label>
                          <textarea name="content" id="content" class="form-control" rows="10" {{ $exist ? 'disabled' : '' }}> {{ $exist ? $about->content : '' }}</textarea>   
                      </div>
                      
                  </div>
                  <div class="tile-footer">
                    
                       
                       <button class="btn btn-primary edit" type="button"><i class="fa fa-fw fa-lg fa-edit"></i>Edit</button>
                      
                        <button class="btn btn-primary" {{ $exist ? 'disabled' :'' }} type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>{{ $exist ? 'Update' : 'Submit' }}</button>
                        

                  </div>

              </div>
               
              <div class="col-md-12 text-right">
                  
              </div>
              <div class="clearix"></div>

          </div>
        </form>
    </div>
</main>
@endsection