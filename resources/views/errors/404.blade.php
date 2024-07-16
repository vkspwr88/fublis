@extends('users.layouts.master')

@section('head')
	<title>404 - Not Found</title>
@endsection

@section('body')
	<div class="col-12">
		<h6 class="m-0 text-purple-700 fw-semibold">404 error</h6>
	</div>
	<div class="col-12">
		<h2 class="m-0 fs-1 fw-bold text-dark">We lost this page</h2>
	</div>
	<div class="col-12">
		<p class="m-0 text-secondary">Sorry, the page you are looking for doesn't exist.</p>
	</div>
@endsection

@section('image')
	<img src="{{ asset('images/errors/fublis-404.png') }}" class="img-fluid" alt="404 Not found">
@endsection
