@extends('dashboard.dashboard-master') @section('content')
 
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-edit"></i>Edit Books</h1>
            <p>Library Holdings</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item"><a href="#">Sample Forms</a></li>
        </ul>
    </div>
    <div class="tile">
        <form method="POST" action="{{ url('admin/books/update') }}">
          @csrf
          @method('patch')
          <input type="hidden" name="id" value="{{ $book->id }}">
          <div class="row">
              <div class="col-md-12">
                  <h3 class="tile-title">Edit Book to library holdings</h3>
              </div>
              <div class="col-md-6">

                  <div class="tile-body">
                      <div class="form-horizontal">
                          <div class="form-group row">
                              <label class="control-label col-md-3">Accession No.</label>
                              <div class="col-md-8">
                                  <input class="form-control" type="text" placeholder="Accession No." name="accession_number" value="{{ $book->accession_number }}">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3" >Location Symbol</label>
                              <div class="col-md-8">
                                  <select class="form-control col-md-12" name="location_symbol" style="width: 100%;" placeholder="Location Symbol">
                                      <option value=""></option>
                                      <option value="Fil" {{ $book->location_symbol == 'Fil' ? 'selected' : '' }}>Fil</option>
                                      <option value="Crim" {{ $book->location_symbol == 'Crim' ? 'selected' : '' }}>Crim</option>
                                      <option value="BA" {{ $book->location_symbol == 'BA' ? 'selected' : '' }}>BA</option>
                                      <option value="Educ" {{ $book->location_symbol == 'Educ' ? 'selected' : '' }}>Educ</option>
                                      <option value="ITE" {{ $book->location_symbol == 'ITE' ? 'selected' : '' }}>ITE</option>
                                      <option value="Cir" {{ $book->location_symbol == 'Cir' ? 'selected' : '' }}>Cir</option>
                                      <option value="Gr" {{ $book->location_symbol == 'Gr' ? 'selected' : '' }}>Gr</option>
                                      <option value="TM" {{ $book->location_symbol == 'TM' ? 'selected' : '' }}>TM</option>
                                      <option value="TB" {{ $book->location_symbol == 'TB' ? 'selected' : '' }}>TB</option>
                                      <option value="Fic" {{ $book->location_symbol == 'Fic' ? 'selected' : '' }}>Fic</option>
                                      <option value="M" {{ $book->location_symbol == 'M' ? 'selected' : '' }}>M</option>
                                  </select>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Classification</label>
                              <div class="col-md-8">
                                  <input class="form-control" type="text" placeholder="Classification" name="classification" value="{{ $book->classification }}">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Title</label>
                              <div class="col-md-8">
                                  <textarea class="form-control" rows="3" placeholder="Title" name="title">{{ $book->title }}</textarea>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Author 1</label>
                              <div class="col-md-8">
                                  <input class="form-control" value="{{ $book->author1 }}" type="text" placeholder="Author 1" name="author1">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Author 2</label>
                              <div class="col-md-8">
                                  <input class="form-control" value="{{ $book->author2 }}" type="text" placeholder="Author 2" name="author2">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Editor</label>
                              <div class="col-md-8">
                                  <input class="form-control" value="{{ $book->editor }}" type="text" placeholder="Editor" name="editor">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Edition</label>
                              <div class="col-md-8">
                                  <input class="form-control" value="{{ $book->edition }}" type="text" placeholder="edition" name="edition">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3" >Place of Publication</label>
                              <div class="col-md-8">
                                  <input class="form-control" value="{{ $book->publication_place }}" type="text" placeholder="Place of Publication" name="publication_place">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Publisher</label>
                              <div class="col-md-8">
                                  <input class="form-control" value="{{ $book->publisher }}" type="text" placeholder="Publisher" name="publisher">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Copyright</label>
                              <div class="col-md-8">
                                  <input class="form-control" value="{{ $book->copyright }}" type="text" placeholder="Copyright" name="copyright">
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Physical Description</label>
                              <div class="col-md-8">
                                  <input class="form-control" value="{{ $book->physical_description }}" type="text" placeholder="Physical Description" name="physical_description">
                              </div>
                          </div>

                      </div>
                  </div>

              </div>
              <div class="col-md-6">
                  <div class="tile-body">
                      <div class="form-horizontal">
                          <div class="form-group row">
                              <label class="control-label col-md-3">Summary</label>
                              <div class="col-md-8">
                                  <textarea class="form-control" rows="3" placeholder="Notes and Summary" name="summary">{{ $book->notes_summary }}</textarea>
                              </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Subject Term 1</label>
                          <div class="col-md-8">
                              <input class="form-control" value="{{ $book->subjectTerm1 }}" type="text" placeholder="Subject Term 1" name="subject_term1">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Subject Term 2</label>
                          <div class="col-md-8">
                              <input class="form-control" type="text" value="{{ $book->subjectTerm2 }}" placeholder="Subject Term 2" name="subject_term2">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Degree Program</label>
                          <div class="col-md-8">
                              <select class="form-control" value="" name="degree_program">
                                  <option value="">Select Degree Program</option>
                                  <option value="BSC" {{ $book->degree_program == 'BSC' ? 'selected' : '' }}>BSC</option>
                                  <option value="General Education" {{ $book->degree_program == 'General Education' ? 'selected' : '' }}>General Education</option>
                                  <option value="BSBA" {{ $book->degree_program == 'BSBA' ? 'selected' : '' }}>BSBA</option>
                                  <option value="BEED" {{ $book->degree_program == 'BEED' ? 'selected' : '' }}>BEED</option>
                                  <option value="BSED" {{ $book->degree_program == 'BSED' ? 'selected' : '' }}>BSED</option>
                                  <option value="BSIT" {{ $book->degree_program == 'BSIT' ? 'selected' : '' }}>BSIT</option>
                                  <option value="BSCS" {{ $book->degree_program == 'BSCS' ? 'selected' : '' }}>BSCS</option>
                                  <option value="General Collection" {{ $book->degree_program == 'General Collection' ? 'selected' : '' }}>General Collection</option>
                                  <option value="SHS" {{ $book->degree_program == 'SHS' ? 'selected' : '' }}>SHS</option>
                                  <option value="JSH" {{ $book->degree_program == 'JSH' ? 'selected' : '' }}>JHS</option>
                                  <option value="GS" {{ $book->degree_program == 'GS' ? 'selected' : '' }}>GS</option>
                                  <option value="BEEd/BSed" {{ $book->degree_program == 'BEEd/BSed' ? 'selected' : '' }}>BEEd/BSEd</option>
                                  <option value="General Education - BSIT" {{ $book->degree_program == 'General Education - BSIT' ? 'selected' : '' }}>General Education - BSIT</option>
                                  <option value="General Education - BSC" {{ $book->degree_program == 'General Education - BSC' ? 'selected' : '' }}>General Education - BSC</option>
                                  <option value="IT/CS" {{ $book->degree_program == 'IT/CS' ? 'selected' : '' }}>IT/CS</option>
                                  <option value="General Education - BEEd" {{ $book->degree_program == 'General Education - BEEd' ? 'selected' : '' }}>General Education - BEEd</option>
                                  <option value="General Education - BSBA" {{ $book->degree_program == 'General Education - BSBA' ? 'selected' : '' }}>General Education - BSBA</option>
                              </select>
                          </div>
                      </div>

                      <div class="form-group row">
                          <label class="control-label col-md-3">Subjet Code Description</label>
                          <div class="col-md-8">
                              <input class="form-control" value="{{ $book->subjectCode_description }}" type="text" placeholder="Subject Code Description" name="subject_code">
                          </div>
                      </div>

                      <div class="form-group row">
                          <label class="control-label col-md-3">ISBN</label>
                          <div class="col-md-8">
                              <input class="form-control" value="{{ $book->isbn }}" type="text" placeholder="ISBN" name="isbn">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Source of Fund</label>
                          <div class="col-md-8">
                              <select class="form-control" name="source_fund">
                                <option value="">Select Source of Fund</option>
                                <option value="Purchased" {{ $book->source_fund == 'Purchased' ? 'selected' : '' }}>Purchased</option>
                                <option value="Donated" {{ $book->source_fund == 'Donated' ? 'selected' : '' }}>Donated</option>
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Date Encoded</label>
                          <div class="col-md-8">
                              <input class="form-control" value="{{ $book->date_encoded }}" type="date" placeholder="Date Encoded" name="date_encoded">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Price</label>
                          <div class="col-md-8">
                              <input class="form-control" value="{{ $book->price }}" type="number" placeholder="Price" name="price">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Loaning Period</label>
                          <div class="col-md-8">
                              <select name="loaning_period" class="form-control">
                                  <option value="">Select Loaning Period</option>
                                  <option value="0" {{ $book->loaning_period == '0' ? 'selected' : '' }}>0</option>
                                  <option value="1" {{ $book->loaning_period == '1' ? 'selected' : '' }}>1</option>
                                  <option value="2" {{ $book->loaning_period == '2' ? 'selected' : '' }}>2</option>
                                  <option value="3" {{ $book->loaning_period == '3' ? 'selected' : '' }}>3</option>
                                  <option value="4" {{ $book->loaning_period == '4' ? 'selected' : '' }}>4</option>
                                  <option value="5" {{ $book->loaning_period == '5' ? 'selected' : '' }}>5</option>
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Status</label>
                          <div class="col-md-8">
                              <select name="status" class="form-control">
                                  <option value="">Select Status</option>
                                  <option value="0" {{ $book->status == '0' ? 'selected' : '' }}>Checked Out</option>
                                  <option value="1" {{ $book->status == '1' ? 'selected' : '' }}>Available</option>
                              </select>
                          </div>
                      </div>
                  </div>

              </div>
              <div class="col-md-12 text-right">
                  <div class="tile-footer">
                      <a id="cancel" class="btn btn-secondary" ><i class="fa fa-fw fa-lg fa-times-circle"></i>Cancel</a> &nbsp;&nbsp;&nbsp;
                      <button class="btn btn-primary" type="submit"><i class="fa fa-fw fa-lg fa-check-circle"></i>Save</button>
                  </div>
              </div>
              <div class="clearix"></div>

          </div>
        </form>
    </div>
</main>
@endsection