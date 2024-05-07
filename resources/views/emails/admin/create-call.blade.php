@extends('emails.layouts.master')

@section('body')
<h2 class="admin-header">New Call for Submission</h4>
<p>Hi Admin,</p>
<p>We're pleased to inform you that a journalist has created a new call for submission on Fublis! Here are the details:</p>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<p style="margin-bottom: 15px;">User Details:</p>
<p><strong>Member Name:</strong> {{ $call->journalist->user->name }}</p>
<p><strong>Call Title:</strong> {{ $call->title }}</p>
<p><strong>Publication:</strong> {{ $call->publication->name }}</p>
<p><strong>Language:</strong> {{ $call->language->name }}</p>
<p><strong>Invited Stories:</strong> {{ $call->publishFrom->name }}</p>
<p><strong>Submission Deadline:</strong> {{ formatDate($call->submission_end_date) }}</p>
<p><strong>Date & Time of Signup:</strong> {{ formatDateTime($call->created_at) }}</p>
{{-- <hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;"> --}}
<p><x-mail::button :url="$mailUrl">View Call</x-mail::button></p>
@endsection
