@extends('emails.layouts.master')

@section('body')
<h2 style="font-size: 30px;">Your Monthly Fublis Stats</h2>
<p class="mb-3">Hi {{ $name }},</p>
<p>We trust you're having a fantastic month! At Fublis, we are committed to providing you with the tools and insights to thrive in your journalistic endeavors. Today, we're excited to share your monthly performance statistics, giving you a glimpse into the impact you're making on our platform.</p>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<p class="mb-3"><strong>Here's a snapshot of your Fublis journey this month:</strong></p>
<div>
<p><strong>Total Pitches Received:</strong> {{ $resultData['total_pitches_received'] }}</p>
<p><strong>Total Calls Created:</strong> {{ $resultData['total_calls_created'] }}</p>
<p><strong>Total Views on Your Calls:</strong> {{ $resultData['total_views'] }}</p>
<p><strong>Total Submissions Received:</strong> {{ $resultData['total_submissions_received'] }}</p>
</div>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<div>
<p><a href="{{ $loginUrl }}" class="link" style="text-decoration: underline;">Login to check individual details →</a></p>
<p>Stay up-to-date with the latest pitches, individual stats on call performance & submissions.</p>
</div>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<div>
<p class="mb-3"><strong>Tips for Enhancing Your Fublis Experience:</strong></p>
<ul>
<li>Keep creating engaging Calls for Submissions.</li>
<li>Engage with content creators to build lasting partnerships.</li>
<li>Explore the submissions received and discover outstanding content.</li>
</ul>
</div>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<div class="mb-3">
<p>Should you have any questions or require assistance, our dedicated support team is always here to assist you.</p>
<p>Thank you for being an integral part of the Fublis community. Your commitment to journalistic excellence is truly commendable, and we're here to support your journey every step of the way.</p>
<p>Stay inspired, stay connected, and keep shaping narratives on Fublis!</p>
<p>— The Fublis team</p>
</div>
<div class="mb-3">
<p><x-mail::button :url="$loginUrl">View Analytics</x-mail::button></p>
</div>
@endsection