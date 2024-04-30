@extends('emails.layouts.master')

@section('body')
<h4>New User Sign-Up</h4>
<p>Hi Admin,</p>
<p>We are thrilled to inform you that a new user has signed up for Fublis! Here are the details:</p>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<p style="margin-bottom: 15px;">User Details:</p>
<p><strong>User Name:</strong> [user name]</p>
<p><strong>Email Address:</strong> [user email]</p>
<p><strong>Company Name:</strong> [company name]</p>
<p><strong>Position in Company:</strong> [position]</p>
<p><strong>Date & Time of Signup:</strong> [date & time]</p>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<p><x-mail::button :url="[url]">User Profile</x-mail::button></p>
@endsection
