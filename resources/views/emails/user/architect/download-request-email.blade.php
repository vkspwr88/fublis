@extends('emails.layouts.master')

@section('body')
<h2 style="font-size: 30px;">Journalist Request for Access</h2>
<p class="mb-3">Hi {{ $name }},</p>
<p>We hope this message finds you well. Exciting news! A journalist has expressed interest in accessing your media kit on Fublis.</p>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<p class="mb-3">Media Kit Details:</p>
<div>
<p><strong>Media Kit Title:</strong> {{ $mediaKitTitle }}</p>
<p><strong>Date of Request:</strong> {{ $requestDate }}</p>
</div>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<div>
<p><a href="{{ $loginUrl }}" class="link" style="text-decoration: underline;">Login to approve request →</a></p>
<p class="mb-3">This is a fantastic opportunity to get your project, press release, or articles published on various platforms. To grant access to the journalist and potentially see your work featured.</p>
<p>By providing access, you're one step closer to gaining valuable exposure for your content. It's an excellent chance to connect with media professionals and expand your reach.</p>
</div>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<div class="mb-3">
<p>Thank you for being a part of the Fublis community. We can't wait to see your content shine on various platforms!</p>
<p>— The Fublis team</p>
</div>
<div class="mb-3">
<x-mail::button :url="$notificationUrl">Approve Request</x-mail::button>
</div>
@endsection
