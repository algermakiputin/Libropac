<!DOCTYPE html>
<html>
<head>
	<title></title>

	@include('dashboard.template.header')
</head>
<body class="app sidebar-mini rtl">
	@include('dashboard.template.topnav')
	@include('dashboard.template.sidebar')
 	@yield('content')

	@include('dashboard.template.footer')
</body>
</html>