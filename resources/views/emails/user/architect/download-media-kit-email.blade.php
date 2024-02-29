@extends('emails.layouts.master')

@section('body')
<h2 style="font-size: 30px;">Journalist Has Downloaded Your Media Kit on Fublis</h2>
<p class="mb-3">Hi {{ $name }},</p>
<p>We hope this message finds you well. We have some exciting news to share! A journalist has shown interest in your media kit on Fublis and has downloaded it.</p>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<p class="mb-3">Media Kit Details:</p>
<div>
<p><strong>Media Kit Title:</strong> {{ $mediaKitTitle }}</p>
<p><strong>Date of Download:</strong> {{ $downloadDate }}</p>
</div>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<div>
<p><a href="{{ $loginUrl }}" class="link" style="text-decoration: underline;">Login to see who have downloaded your media kit →</a></p>
<p class="mb-3">This download represents a significant step forward in getting your project, press release, or articles published on various platforms. To learn more about the journalist who has expressed interest, please login to view their profile and credentials.</p>
<p>By understanding your audience better, you can tailor your content and pitches for greater success.</p>
</div>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<div class="mb-3">
<p class="mb-3">If you have any questions or need further assistance, please don't hesitate to reach out to our support team. We're here to help you make the most of your Fublis experience.</p>
<p class="mb-3">Thank you for being a part of the Fublis community. Your dedication to your work is commendable, and we're here to support your journey.</p>
<p>— The Fublis team</p>
</div>
<div class="mb-3">
<p><x-mail::button :url="$loginUrl">Login</x-mail::button></p>
</div>
@endsection
