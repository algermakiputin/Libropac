@extends('master')

@section('content')
<script type="text/javascript">
	jQuery(document).ready(function($){
		'use strict';
		jQuery('body').backstretch([
			"{{url('assets/images/header/1.JPG')}}", 
			], {duration: 5000, fade: 700, centeredY: true });

		
	});
</script>
<section id="single-page-slider" class="no-margin">
	<div class="carousel slide" data-ride="carousel">
		<div class="carousel-inner">
			<div class="item active">
				<div class="container">
					<div class="row">
						<div class="col-md-12">
							<div class="center gap fade-down section-heading">
								<h2 class="main-title">Ask Librarian</h2>
								<hr>
								<p>Ask us, report a problem, or give us feedback</p>
							</div>
						</div>   
					</div>
				</div>
			</div><!--/.item-->
		</div><!--/.carousel-inner-->
	</div><!--/.carousel-->
</section><!--/#main-slider-->
<div id="content-wrapper">
	<section id="services" class="white">
		<div class="container">
			<div class="gap"></div>  
			<div class="row">
				<div class="col-md-offset-2 col-md-8">
					 
					 
					 
                            <h3>Send as your question</h3>
                            <br>
                            <br>
                            	<div class="alert alert-success" id="success">
                            		 
						 		<b>Success!</b> Your question is submitted successfully and waiting for review.
						</div>
                            <div id="message"></div>
                            <form method="post" id="askForm">
                            	@csrf
                            		<div class="form-group">
                            			<input required="required" type="text" name="name" id="name" class="form-control" placeholder="Name">
                            		</div>
                                	<div class="form-group">
                                		<input required="required" class="form-control" type="text" name="question" id="question" placeholder="Ask question, problem, feedback">
                                	</div>
                                	<div class="form-group">
                                		<textarea class="form-control" required="required" name="details" id="comments" placeholder="More details"></textarea>
                                	</div>
                                	<div class="form-group">
                                		<button class="btn btn-outlined btn-primary" type="submit" name="submit"><div class="loader-submit"></div><span class="text">Submit</span></button>
                                	</div>
                            </form>
                         
				</div>
			</div>           
			<div class="gap"></div>
		</div>
	</section>
</div>

@endsection


