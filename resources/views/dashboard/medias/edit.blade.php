@extends('dashboard.dashboard-master') @section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i>Edit Media</h1>
            <p>Library Holdings</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item"><a href="#">Sample Forms</a></li>
        </ul>
    </div>
    <div class="tile">
        <form method="POST" action="{{ url('admin/media/update') }}">
          @csrf
          @method('patch');
          <div class="row">
              <div class="col-md-12">
                  <h3 class="tile-title">Edit Media to library holdings</h3>
              </div>
              
              <div class="col-md-6">
                  <input type="hidden" name="id" value="{{ $media->id }}">
                  <div class="tile-body">
                      <div class="form-horizontal">
                          <div class="form-group row">
                              <label class="control-label col-md-3">Accession No.</label>
                              <div class="col-md-8">
                                  <input class="form-control" type="text" placeholder="Accession No." name="accession_number" value="{{ $media->accession_number }}" readonly="">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Title</label>
                              <div class="col-md-8">
                                  <textarea class="form-control" rows="3" placeholder="Title" name="title">{{ $media->title }}</textarea>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Author</label>
                              <div class="col-md-8">
                                  <input class="form-control" value="{{ $media->author }}" type="text" placeholder="Author" name="author">
                              </div>
                          </div>
                          
                          <div class="form-group row">
                              <label class="control-label col-md-3">Publisher</label>
                              <div class="col-md-8">
                                  <input class="form-control" value="{{ $media->publisher }}" type="text" placeholder="Publisher" name="publisher">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Copyright</label>
                              <div class="col-md-8">
                                  <input class="form-control" value="{{ $media->copyright }}" type="text" placeholder="Copyright" name="copyright">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Type</label>
                              <div class="col-md-8">
                                  <select class="form-control" name="type">
                                       <option value="">Select Media Type</option>
                                       <option value="VCD" {{ $media->type == "VCD" ? 'selected' : '' }}>VCD</option>
                                       <option value="DVD" {{ $media->type == "DVD" ? 'selected' : '' }}>DVD</option>
                                       <option value="CD" {{ $media->type == "CD" ? 'selected' : '' }}>CD</option>
                                       <option value="VHS" {{ $media->type == "VHS" ? 'selected' : '' }}>VHS</option>
                                       <option value="Audio Tape" {{ $media->type == "Audio Tape" ? 'selected' : '' }}>Audio Tape</option>
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
                              <input class="form-control" value="{{ $media->subjectTerm1 }}" type="text" placeholder="Subject Term 1" name="subject_term1">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Subject Term 2</label>
                          <div class="col-md-8">
                              <input class="form-control" value="{{ $media->subjectTerm2 }}" type="text" placeholder="Subject Term 2" name="subject_term2">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Degree Program</label>
                          <div class="col-md-8">
                              <select class="form-control" value="" name="degree_program">
                                  <option value="">Select Degree Program</option>
                                  <option value="BSC" {{ $media->degree_program == 'BSC' ? 'selected' : '' }}>BSC</option>
                                  <option value="General Education" {{ $media->degree_program == 'General Education' ? 'selected' : '' }}>General Education</option>
                                  <option value="BSBA" {{ $media->degree_program == 'BSBA' ? 'selected' : '' }}>BSBA</option>
                                  <option value="BEED" {{ $media->degree_program == 'BEED' ? 'selected' : '' }}>BEED</option>
                                  <option value="BSED" {{ $media->degree_program == 'BSED' ? 'selected' : '' }}>BSED</option>
                                  <option value="BSIT" {{ $media->degree_program == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                                  <option value="BSCS" {{ $media->degree_program == 'BSCS' ? 'selected' : '' }}>BSCS</option>
                                  <option value="General Collection" {{ $media->degree_program == 'General Collection' ? 'selected' : '' }}>General Collection</option>
                                  <option value="SHS" {{ $media->degree_program == 'SHS' ? 'selected' : '' }}>SHS</option>
                                  <option value="JSH" {{ $media->degree_program == 'JSH' ? 'selected' : '' }}>JHS</option>
                                  <option value="GS" {{ $media->degree_program == 'GS' ? 'selected' : '' }}>GS</option>
                                  <option value="BEEd/BSed" {{ $media->degree_program == 'BEEd/BSed' ? 'selected' : '' }}>BEEd/BSEd</option>
                                  <option value="General Education - BSIT" {{ $media->degree_program == 'General Education - BSIT' ? 'selected' : '' }}>General Education - BSIT</option>
                                  <option value="General Education - BSC" {{ $media->degree_program == 'General Education - BSC' ? 'selected' : '' }}>General Education - BSC</option>
                                  <option value="IT/CS" {{ $media->degree_program == 'IT/CS' ? 'selected' : '' }}>IT/CS</option>
                                  <option value="General Education - BEEd" {{ $media->degree_program == 'General Education - BEEd' ? 'selected' : '' }}>General Education - BEEd</option>
                                  <option value="General Education - BSBA" {{ $media->degree_program == 'General Education - BSBA' ? 'selected' : '' }}>General Education - BSBA</option>
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Subject Code</label>
                          <div class="col-md-8">
                              <input class="form-control" type="text" placeholder="Subject Code" name="subject_code" value="{{ $media->subject_code }}">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Source of Fund</label>
                          <div class="col-md-8">
                              <select required="required" class="form-control" name="source_fund">
                                <option value="">Select Source of Fund</option>
                                <option value="Purchased" {{ $media->source_fund == "Purchased" ? "selected" : '' }}>Purchased</option>
                                <option value="Donated" {{ $media->source_fund == "Donated" ? "selected" : '' }}>Donated</option>
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Date Encoded</label>
                          <div class="col-md-8">
                              <input class="form-control" type="date" placeholder="Date Encoded" name="encoded" value="{{ $media->encoded }}">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Price</label>
                          <div class="col-md-8">
                              <input class="form-control" value="{{ $media->price }}" type="number" placeholder="Price" name="price">
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