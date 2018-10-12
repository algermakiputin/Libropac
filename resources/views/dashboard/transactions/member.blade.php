@extends('dashboard.dashboard-master') @section('content')
<main class="app-content">
    <div class="app-title">
        <div>
            <h1><i class="fa fa-exchange"></i> Member Transactions</h1>
            <p>Library Holdings</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
            <li class="breadcrumb-item"><i class="fa fa-home fa-lg"></i></li>
            <li class="breadcrumb-item">Forms</li>
            <li class="breadcrumb-item"><a href="#">Sample Forms</a></li>
        </ul>
    </div>
    <div class="tile">
        <form method="POST" action="{{ url('admin/transactions/insert') }}">
          @csrf
          <input type="hidden" name="m_id" id="m_id">
          <input type="hidden" name="member" value="1">
          <input type="hidden" name="membership_type" id="membership_type">
          <div class="row">
              <div class="col-md-12">
                  <h3 class="tile-title">Barrowers form</h3>
              </div>
              <div class="col-md-6">

                  <div class="tile-body">
                      <div class="form-horizontal">
                          <div class="form-group row">
                              <label class="control-label col-md-3">Transaction ID</label>
                              <div class="col-md-8">
                                  <input class="form-control" type="text" readonly name="transaction_id" value="{{  $transaction_id }}">
                              </div>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Member ID</label>
                          <div class="col-md-8">
                              <input class="form-control" type="text" name="member_id" id="member_id" placeholder="Enter Member ID">
                          </div>
                      </div>

                      <div id="student">
                          <div class="form-horizontal">
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Name</label>
                                  <div class="col-md-8">
                                      <input class="form-control" type="text" id="s_name" placeholder="name" name="name" readonly="readonly">
                                  </div>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Gender</label>
                              <div class="col-md-9">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input"  value="male" type="radio" name="gender">Male
                                  </label>
                                </div>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input readonly="readonly" class="form-check-input" value="female" type="radio" name="gender">Female
                                  </label>
                                </div>
                              </div>
                            </div>
                          <div class="form-horizontal">
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Select Course</label>
                                  <div class="col-md-8">
                                      <select readonly="readonly" class="form-control" name="course">
                                        <option value="">Select Course</option>
                                        <option value="BEED">BEED</option>
                                        <option value="BSED">BSED</option>
                                        <option value="BSBA">BSBA</option>
                                        <option value="BSC">BSC</option>
                                        <option value="BSCS">BSCS</option>
                                        <option value="BSIT">BSIT</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="form-horizontal">
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Year</label>
                                  <div class="col-md-8">
                                      <select readonly="readonly" class="form-control" name="year">
                                        <option value="">Select Year</option>
                                        <option value="1st">1st</option>
                                        <option value="2nd">2nd</option>
                                        <option value="3rd">3rd</option>
                                        <option value="4th">4th</option>
                                        <option value="5th">5th</option>
                                      </select>
                                  </div>
                              </div>
                          </div>
                          <div class="form-horizontal">
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Address</label>
                                  <div class="col-md-8">
                                      <input readonly="readonly" class="form-control" type="text" name="address" placeholder="Address">
                                  </div>
                              </div>
                          </div>
                          <div class="form-horizontal">
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Contact Number</label>
                                  <div class="col-md-8">
                                      <input readonly="readonly" placeholder="Contact number" class="form-control" type="text" name="contact">
                                  </div>
                              </div>
                          </div>
                      </div>
                      <div id="faculty">
                          <div class="form-horizontal">
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Name</label>
                                  <div class="col-md-8">
                                      <input readonly="readonly" class="form-control" type="text" placeholder="Name" name="f_name">
                                  </div>
                              </div>
                          </div>
                          <div class="form-group row">
                              <label class="control-label col-md-3">Gender</label>
                              <div class="col-md-9">
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" value="male" type="radio" name="f_gender">Male
                                  </label>
                                </div>
                                <div class="form-check">
                                  <label class="form-check-label">
                                    <input class="form-check-input" value="female" type="radio" name="f_gender">Female
                                  </label>
                                </div>
                              </div>
                            </div>
                            <div class="form-horizontal">
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Position</label>
                                  <div class="col-md-8">
                                      <input readonly="readonly" class="form-control" type="text" placeholder="Position" name="f_position">
                                  </div>
                              </div>
                            </div>
                            
                          <div class="form-horizontal">
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Address</label>
                                  <div class="col-md-8">
                                      <input readonly="readonly" class="form-control" placeholder="Address" type="text" name="f_address">
                                  </div>
                              </div>
                          </div>
                          <div class="form-horizontal">
                              <div class="form-group row">
                                  <label class="control-label col-md-3">Contact Number</label>
                                  <div class="col-md-8">
                                      <input readonly="readonly" class="form-control" placeholder="Contact Number" type="text" name="f_contact">
                                  </div>
                              </div>
                          </div>
                      </div>
                  </div>
                  
              </div>
   
              <div class="col-md-6">
                  <div class="tile-body">
                      
                      
                        <div class="form-group row">
                          <label class="control-label col-md-3">Date Time</label>
                          <div class="col-md-8">
                              <input class="form-control" type="text" name="date" value="{{ $date }}" readonly="readonly">
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Loaning Period</label>
                          <div class="col-md-8">
                              <select name="loaning_period" class="form-control">
                                <option value="">Select Loaning Period</option>
                                <option value="3">3 Hours</option>
                                <option value="24">1 Day</option>
                                <option value="72">3 Day</option>
                                <option value="168">1 Week</option>
                                <option value="336">2 Weeks</option>
                                <<option value="1344">8 Weeks</option>
                              </select>
                          </div>
                      </div>
                      <div class="form-group row">
                          <label class="control-label col-md-3">Barrow</label>
                          <div class="col-md-8">
                              <select name="barrow" id="barrow" class="form-control">
                                <option value="">Select what to Barrow</option>
                                <option value="book">Book</option>
                                <option value="media">Media</option>
                              </select>
                          </div>
                      </div>

                      <div id="barrow_book">
                        <div class="form-group row" >
                            <label class="control-label col-md-3">Select Book</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" id="select_book" name="select_book" placeholder="Select Book">
                                <input type="hidden" name="book_id" id="book_id">
                            </div>
                        </div>
                      </div>
                      <div id="barrow_media">
                        <div class="form-group row" >
                            <label class="control-label col-md-3">Select Media</label>
                            <div class="col-md-8">
                                <input class="form-control" type="text" id="select_media" name="select_media" placeholder="Select Media">
                                <input type="hidden" name="media_id" id="media_id">
                            </div>
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

<div class="modal" tabindex="-1" role="dialog" id="select-book-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select Book</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-hover table-bordered" id="select_books_table">
            <thead>
                <tr >
                    <th>ID</th>
                    <th>Class No.</th>
                    <th>Book Title</th>
                    <th>Author 1</th>
                    <th>Status</th>
                    <th>Loaning Period</th>
                </tr>
            </thead>
        </table>
      </div>
      <div class="modal-footer">
  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<div class="modal" tabindex="-1" role="dialog" id="select-media-modal">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title">Select Book</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <table class="table table-hover table-bordered" id="select_media_table">
            <thead>
              <tr >
                <th>ID</th>
                <th>Title</th>
                <th>Author</th>
                <th>Type</th>
               
                <th>Accession Number</th>
              </tr>
            </thead>
          </table>
      </div>
      <div class="modal-footer">
  
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
@endsection