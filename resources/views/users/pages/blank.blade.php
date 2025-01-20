@extends('users.layouts.master')

{!! seo() !!}

@section('body')
	@php
		$senderEmail = 'amansaini87@rediffmail.com';
	@endphp
	{{ Str::mask($senderEmail, '*', 3, Str::length($senderEmail) - 6) }}
@endsection
