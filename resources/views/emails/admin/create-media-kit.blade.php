@extends('emails.layouts.master')

@section('body')
<h2 class="admin-header">New Media Kit Creation</h2>
<p>Hi Admin,</p>
<p>We are excited to inform you that a new media kit has been created on Fublis! Here are the details:</p>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<p style="margin-bottom: 15px;">User Details:</p>
<p><strong>User Name:</strong> {{ $mediaKit->architect->user->name }}</p>
<p><strong>Media Kit Title:</strong> {{ $mediaKit->story->title }}</p>
<p><strong>Media Kit Type:</strong> {{ showModelName($mediaKit->story_type) }}</p>
<p><strong>Category:</strong> {{ $mediaKit->category->name }}</p>
<p><strong>Company Name:</strong> {{ $mediaKit->architect->company->name }}</p>
<p><strong>Date & Time of Media Kit:</strong> {{ formatDateTime($mediaKit->created_at) }}</p>
{{-- <hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;"> --}}
<p><x-mail::button :url="$mailUrl">View Media Kit</x-mail::button></p>
@endsection
