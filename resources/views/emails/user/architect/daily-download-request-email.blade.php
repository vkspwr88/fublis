@extends('emails.layouts.master')

@section('body')
<h2 style="font-size: 30px;">You've Got New Download Requests! Approve Them to Get Published</h2>
<p class="mb-3">Hi {{ $name }},</p>
<p>We hope this email finds you well. We are excited to inform you that you have received new download requests from journalists for your media kits on Fublis. This is a fantastic opportunity to get your stories published and gain the visibility your work deserves.</p>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<div>
<p class="mb-3">Download Requests:</p>
@foreach ($mediaKitTitles as $mediaKitTitles)
<p><strong>Media Kit:</strong> {{ $mediaKitTitles }}</p>
@endforeach
</div>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<div>
<p><a href="{{ $loginUrl }}" class="link" style="text-decoration: underline;">Login to approve request →</a></p>
<p class="mb-3">Log in now to review and approve these requests.</p>
<p><strong>Steps to follow:</strong></p>
<ul>
<li style="margin-bottom: 0;">Login to Your Fublis <strong>Account</strong>.</li>
<li style="margin-bottom: 0;">Review Download Requests: <strong>Navigate to the 'Notifications'</strong> section to see the details.</li>
<li style="margin-bottom: 0;">Approve Requests: <strong>Click 'Approve'</strong> to allow journalists to download your media kits.</li>
</ul>
</div>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<div>
<p><strong>Why approve these requests?</strong></p>
<ul>
<li style="margin-bottom: 0;"><strong>Get Published:</strong> Each approval brings you one step closer to getting your stories featured in top publications.</li>
<li style="margin-bottom: 0;"><strong>Increased Visibility:</strong> Reach a wider audience and enhance your brand's presence in the media.</li>
<li style="margin-bottom: 0;"><strong>Build Credibility:</strong> Establish your reputation by being featured in reputable journals and publications.</li>
<li style="margin-bottom: 0;"><strong>Direct Engagement:</strong> Engage directly with journalists and editors who are interested in your work.</li>
</ul>
</div>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<div class="mb-3">
<p>Thank you for being a part of the Fublis community. We can't wait to see your content shine on various platforms!</p>
</div>
<div class="mb-3">
<p><x-mail::button :url="$notificationUrl">Approve Request</x-mail::button></p>
</div>
@endsection
