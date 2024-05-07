@extends('emails.layouts.master')

@section('body')
<h2 class="admin-header">New User Sign-Up</h2>
<p>Hi Admin,</p>
<p>We are thrilled to inform you that a new user has signed up for Fublis! Here are the details:</p>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<p style="margin-bottom: 15px;">User Details:</p>
<p><strong>User Name:</strong> {{ $architect->user->name }}</p>
<p><strong>Email Address:</strong> {{ $architect->user->email }}</p>
<p><strong>Company Name:</strong> {{ $architect->company->name }}</p>
<p><strong>Position in Company:</strong> {{ $architect->position->name }}</p>
<p><strong>Date & Time of Signup:</strong> {{ formatDateTime($architect->created_at) }}</p>
{{-- <hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;"> --}}
<p><x-mail::button :url="$mailUrl">User Profile</x-mail::button></p>
@endsection
