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
								<h2 class="main-title">Library FAQS</h2>
								<hr>
								<p>Read Frequenlty Ask Quenstions</p>
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
				<div class=" col-md-12">
					 <div class="text-center" id="pagination">{{ $faqs->links() }}</div>
					 <div id="accordion">

                          @foreach ($faqs as $faq)

                              <div class="card">
	                              <div class="card-header" id="headingOne">
	                                  <h5 class="mb-0">
	                                    <a class="btn btn-link" data-toggle="collapse" data-target="#faq{{ $faq->id }}" aria-expanded="true" aria-controls="collapseOne">
	                                      <b>Q. {{ $faq->question }}</b>
	                                  </a>
	                              </h5>
	                          	</div>

	                          	<div id="faq{{ $faq->id }}" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
		                              <div class="card-body">
		                              	<span class="faq-header">Answerd by: {{ ucwords($faq->u_name) }}, on {{ date('F jS, Y', strtotime($faq->updated_at)) }}</span>
		                                 {!! preg_replace("/\n/", "<br />", $faq->answer)!!}
		                            </div>
		                        </div>
		                    </div>

	                    @endforeach

                </div>
                         
				</div>
			</div>           
			<div class="gap"></div>
		</div>
	</section>
</div>

@endsection


