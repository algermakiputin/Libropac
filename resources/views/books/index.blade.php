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
								<h2 class="main-title">Books</h2>
								<hr>
								<p>Online Public Access Catalog</p>
								 
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
				<div class="col-md-12">
					<table class="table table-hover table-bordered" id="books_table">
						<thead>
							<tr >
								<th><div>Location Symbol</div></th>
								<th>Class No.</th>
								<th>Book Title</th>
								<th>Author 1</th>
								<th>Subject Code</th>
								<th>Status</th>
								<th>Loaning Period</th>
							</tr>
						</thead>
					</table>
				</div>
			</div>           
			<div class="gap"></div>
		</div>
	</section>
</div>



@endsection


