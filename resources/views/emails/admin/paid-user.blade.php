@extends('emails.layouts.master')

@section('body')
<h4>User Plan Upgrade Notification</h4>
<p>Hi Admin,</p>
<p>We're excited to share that a user has upgraded their plan and become a paid member on Fublis! Here are the details:</p>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<p style="margin-bottom: 15px;">User Details:</p>
<p><strong>User Name:</strong> {{ $user->name }}</p>
<p><strong>New Plan:</strong> {{ $user->latestSubscription->subscriptionPrice->plan_name }}</p>
<p><strong>Email Address:</strong> {{ $user->email }}</p>
<p><strong>Company Name:</strong> {{ $user->architect->company->name }}</p>
<p><strong>Position in Company:</strong> {{ $user->architect->position->name }}</p>
<p><strong>Date & Time of Signup:</strong> {{ $user->name }}</p>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<p><x-mail::button :url="{{ env('APP_URL') . '/backend/architects/' . $user->architect->slug }}">User Profile</x-mail::button></p>
@endsection
