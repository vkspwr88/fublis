@extends('emails.layouts.master')

@section('body')
<h2 style="font-size: 30px;">Your Monthlyly Fublis Stats</h2>
<p class="mb-3">Hi {{ $name }},</p>
<p>We trust you're having a fantastic month! At Fublis, we are committed to helping you get your content published and recognized by a wider audience. As part of our efforts to keep you informed and empowered, we're excited to share your monthly content performance stats.</p>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<p class="mb-3"><strong>Here's a snapshot of your Fublis journey this month:</strong></p>
<div>
<p><strong>Total Media Kits Created:</strong> {{ $resultData['total_media_kits'] }}</p>
<p><strong>Total Pitches Sent:</strong> {{ $resultData['total_pitches_sent'] }}</p>
<p><strong>Total Views:</strong> {{ $resultData['total_views'] }}</p>
<p><strong>Total Downloads:</strong> {{ $resultData['total_downloads'] }}</p>
</div>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<div>
<p><a href="{{ $loginUrl }}" class="link" style="text-decoration: underline;">Login to check your individual Media Kit Stats →</a></p>
<p>Stay up-to-date with the latest stats on media kit performance.</p>
</div>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<div>
<p class="mb-3"><strong>Tips for Maximizing Your Fublis Experience:</strong></p>
<ul>
<li>Craft engaging and informative Media Kits.</li>
<li>Keep an eye on your content's performance and adjust your pitching strategy accordingly.</li>
<li>Explore Calls for Submissions and collaborate with journalists and publishers.</li>
</ul>
</div>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<div class="mb-3">
<p>Got questions or need assistance? Feel free to reach out to our dedicated support team, and we'll be happy to assist you.</p>
<p>Thank you for being a valued member of the Fublis community. Your dedication to quality content is inspiring, and we're here to help you every step of the way.</p>
<p>Stay creative, stay connected, and keep shining on Fublis!, send us a message at hello@fublis.com. We'd love to hear from you.</p>
<p>— The Fublis team</p>
</div>
<div class="mb-3">
<p><x-mail::button :url="$analyticUrl">View Analytics</x-mail::button></p>
</div>
@endsection
