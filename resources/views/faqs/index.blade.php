@extends('dashboard.dashboard-master') 

@section('content')
<main class="app-content">
      <div class="app-title">
        <div>
          <h1><i class="fa fa-question"></i> Faqs</h1>
          <p>Frequently Ask Questions</p>
        </div>
        <ul class="app-breadcrumb breadcrumb">
          <li class="breadcrumb-item"><i class="fa fa-dashboard fa-lg"></i></li>
          <li class="breadcrumb-item">Faqs</li>
 
        </ul>
      </div>
       <div class="tile">
      <div class="row">
         <div class="col-md-12">
          
             <table class="table table-bordered table-hover table-stripped" id="faq_table">
               <thead>
                 <th>Name</th>
                 <th>Question</th>
                 <th>Details</th>
                 <th>Status</th>
                 <th>Action</th>
               </thead>
               <tbody>
                 
               </tbody>
             </table>
           </div>
         </div>
      </div>
    </main>
    
<div class="modal fade" id="answer" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <form method="POST" id="answer_form">
    @csrf
    @method('patch')
    <div class="modal-dialog" role="document">
      <div class="modal-content" style="display: none;">
        
        <div class="modal-header">
          
          <h5 class="modal-title" id="modal-title">Q. where do you live?</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>

        </div>
        <div class="modal-body">
            <div class="alert alert-success" id="alert">
              Answer updated successfully 
            </div>
            <div class="form-group"> 
              <textarea rows="8" placeholder="Answer..." class="form-control" name="answer" id="answer"></textarea>
            </div>
            <input type="hidden" name="id" id="faq-id">

        </div>

        <div class="modal-footer">

          <button type="button" class="btn btn-secondary" data-dismiss="modal" id="test">Close</button>
          <button type="submit" class="btn btn-primary"><div class="m-loader mx-auto" >
                <svg class="m-circular" viewBox="25 25 50 50">
                  <circle class="path" cx="50" cy="50" r="20" fill="none" stroke-width="4" stroke-miterlimit="10"></circle>
                </svg>
              </div><span class="text">Save changes</span></button>
        </div>
      </div>
    </div>
  </form>
</div>
@endsection