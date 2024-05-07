@extends('emails.layouts.master')

@section('body')
<h2 class="admin-header">New Member Sign-Up</h2>
<p>Hi Admin,</p>
<p>We are thrilled to inform you that a new member has signed up for Fublis! Here are the details:</p>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<p style="margin-bottom: 15px;">User Details:</p>
<p><strong>Member Name:</strong> {{ $journalist->user->name }}</p>
<p><strong>Email Address:</strong> {{ $journalist->user->email }}</p>
<p><strong>Publication Name:</strong> {{ $journalist->publications[0]->name }}</p>
<p><strong>Location:</strong> {{ $journalist->publications[0]->location->name }}</p>
<p><strong>Position in Publication:</strong> {{ $journalist->publications[0]->name }}</p>
<p><strong>Date & Time of Signup:</strong> {{ formatDateTime($journalist->created_at) }}</p>
{{-- <hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;"> --}}
<p><x-mail::button :url="$mailUrl">Member Profile</x-mail::button></p>
@endsection
