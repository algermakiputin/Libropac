<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="">
    <meta name="author" content="">
    <meta name="csrf-token" content="{{ csrf_token() }}" />
    <title>Library System - Holy Child College of Davao</title>

	@include('template.header')
</head>
<body>
	<div id="preloader"></div>
	@include('template.navigation')

	@yield('content')

	<div id="footer-wrapper"  >
	    <footer id="footer" class="">
	        <div class="container">
	            <div class="row">
	                <div class="col-sm-8">
	                    &copy; 2018 Holy Child College of Davao Library System. Developed By: <a href="https://algermakiputin.com">Alger Makiputin</a>
	                </div>
	                <div class="col-sm-4">
	                    <ul class="pull-right">
	                        <li><a id="gototop" class="gototop" href="#"><i class="fa fa-chevron-up"></i></a></li><!--#gototop-->
	                    </ul>
	                </div>
	            </div>
	        </div>
	    </footer><!--/#footer-->
	</div>
	@include('template.footer');
</body>
</html>