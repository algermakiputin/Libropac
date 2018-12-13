@extends('dashboard.dashboard-master') @section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i>Add Media</h1>
            <p>Library Holdings</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">New Media</li> 
        </ul>
    </div>
    <div class="tile">
        <form method="POST" action="{{ url('admin/media/insert') }}" id="media_register_form">
          @csrf
          <div class="row">
              <div class="col-md-12">
                  <h3 class="tile-title">Add Media to library holdings</h3>
              </div>
              @if (Session::has('success'))
              <div class="col-md-12">
                <div class="alert alert-success">
                  {{ Session::get('success') }}
                </div>
              </div>
              @endif
              @if ($errors->any())
                <div class="col-md-12">
                  <div class="alert alert-danger">
                    <ul>
                 
                    @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                  </ul>
                  </div>
                </div>
              @endif
              <div class="col-md-6">
                  <div class="tile-body">
                      <div class="form-horizontal">
                          <div class="form-group row">
                              <label class="control-label col-md-3">Accession No.</label>
                              <div class="col-md-8">
                                  <input class="form-control" type="text" placeholder="Accession No." name="accession_number" readonly="" value="{{ $accession_num }}" required="required">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Title</label>
                              <div class="col-md-8">
                                  <textarea class="form-control" required="required" rows="3" placeholder="Title" name="title"></textarea>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Author</label>
                              <div class="col-md-8">
                                  <input class="form-control" required="required" type="text" placeholder="Author" name="author">
                              </div>
                          </div>
                          
                          <div class="form-group row">
                              <label class="control-label col-md-3">Publisher</label>
                              <div class="col-md-8">
                                  <input class="form-control" required="required" type="text" placeholder="Publisher" name="publisher">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Copyright</label>
                              <div class="col-md-8">
                                  <input class="form-control" required="required" type="text" placeholder="Copyright" name="copyright">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Type</label>
                              <div class="col-md-8">
                                  <select class="form-control" name="type" required="required">
                                       <option value="">Select Media Type</option>
                                       <option value="VCD">VCD</option>
                                       <option value="DVD">DVD</option>
                                       <option value="CD">CD</option>
                                       <option value="VHS">VHS</option>
                                       <option value="Audio Tape">Audio Tape</option>
                                  </select>
                              </div>
                          </div>

                      </div>
                  </div>

              </div>
              <div class="col-md-6">
                  <div class="tile-body">
                   
                      <div class="form-group row">
                          <label class="control-label col-md-3">Subject Term 1</label>
                          <div class="col-md-8">
                              <input class="form-control" required="required" type="text" placeholder="Subject Term 1" name="subjectTerm1">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Subject Term 2</label>
                          <div class="col-md-8">
                              <input class="form-control" required="required" type="text" placeholder="Subject Term 1" name="subjectTerm2">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Degree Program</label>
                          <div class="col-md-8">
                              <select class="form-control" required="required" value="" name="degree_program">
                                  <option value="">Select Degree Program</option>
                                  <option value="BSC">BSC</option>
                                  <option value="General Education">General Education</option>
                                  <option value="BSBA">BSBA</option>
                                  <option value="BEED">BEED</option>
                                  <option value="BSED">BSED</option>
                                  <option value="BSIT">BSIT</option>
                                  <option value="BSCS">BSCS</option>
                                  <option value="General Collection">General Collection</option>
                                  <option value="SHS">SHS</option>
                                  <option value="JSH">JHS</option>
                                  <option value="GS">GS</option>
                                  <option value="BEEd/BSed">BEEd/BSEd</option>
                                  <option value="General Education - BSIT">General Education - BSIT</option>
                                  <option value="General Education - BSC">General Education - BSC</option>
                                  <option value="IT/CS">IT/CS</option>
                                  <option value="General Education - BEEd">General Education - BEEd</option>
                                  <option value="General Education - BSBA">General Education - BSBA</option>
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Subject Code</label>
                          <div class="col-md-8">
                              <input class="form-control" required="required" type="text" placeholder="Subject Code" name="subject_code">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Source of Fund</label>
                          <div class="col-md-8">
                              <select required="required" class="form-control" name="source_fund">
                                <option value="">Select Source of Fund</option>
                                <option value="Purchased">Purchased</option>
                                <option value="Donated">Donated</option>
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Date Encoded</label>
                          <div class="col-md-8">
                              <input class="form-control" required="required" type="date" placeholder="Date Encoded" name="encoded">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Price</label>
                          <div class="col-md-8">
                              <input class="form-control" required="required" type="number" placeholder="Price" name="price">
                          </div>
                      </div>

                  </div>

              </div>
              <div class="col-md-12 text-right">
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