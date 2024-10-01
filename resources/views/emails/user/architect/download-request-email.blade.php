@extends('emails.layouts.master')

@section('body')
<h2 style="font-size: 30px;">You've Got New Download Request! Approve This to Get Published</h2>
<p class="mb-3">Hi {{ $name }},</p>
<p>We hope this message finds you well. We are excited to inform you that a journalist has requested to download your media kit on Fublis. This is a fantastic opportunity to get your stories published and gain the visibility your work deserves.</p>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<p class="mb-3"><strong>Publication Details:</strong></p>
<div>
<p><strong>Journalist:</strong> {{ $data['journalist'] }}</p>
<p><strong>Publication:</strong> {{ $data['publication'] }}</p>
<p><strong>Media Kit Title:</strong> {{ $mediaKitTitle }}</p>
<p><strong>Date of Request:</strong> {{ $data['requestTime'] }} hours | {{ $data['requestDate'] }}</p>
</div>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<div>
<p><a href="{{ $loginUrl }}" class="link" style="text-decoration: underline;">Login to approve request →</a></p>
<div class="mb-3">
<p>Thank you for being a part of the Fublis community. We can't wait to see your content shine on various platforms!</p>
<p>— The Fublis team</p>
</div>
<div class="mb-3">
<p><x-mail::button :url="$notificationUrl">Approve Request</x-mail::button></p>
</div>
@endsection
