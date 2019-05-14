<!DOCTYPE html>
<html lang="en">
<html>
	<head>
		<title>@yield('title')</title>
		@include('../layouts/header')
	</head>
	<body>
	@include('../layouts/nav')
		<main class="main-content">
			@yield('user_body')
		</main>
	@include('../layouts/footer')
	</body>
<html>
