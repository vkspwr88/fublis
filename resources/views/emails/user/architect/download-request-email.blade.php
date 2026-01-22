@extends('emails.layouts.master')

@section('body')
<h2 style="font-size: 30px;">You Have New Publication Requests! Approve Them to Get Featured</h2>
<p class="mb-3">Hi {{ $name }},</p>
<p>Exciting news! Your projects are drawing direct interest from journalists on Fublis who are keen to share your work. This level of attention opens up an incredible opportunity to see your designs featured and gain the visibility they deserve in top publications.</p>
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
@if ($data['subscribed'])
<p><a href="{{ $loginUrl }}" class="link" style="text-decoration: underline;">Login to approve request →</a></p>
<div class="mb-3">
<p>Thank you for being a part of the Fublis community. We can't wait to see your content shine on various platforms!</p>
<p>— The Fublis team</p>
</div>
<div class="mb-3">
<p><x-mail::button :url="$loginUrl">Approve Request</x-mail::button></p>
</div>
@else
<p><a href="{{ $upgradeUrl }}" class="link" style="text-decoration: underline;">Upgrade to approve request →</a></p>
<div class="mb-3">
<p>By upgrading your account, you can approve these requests and seamlessly connect with journalists ready to share your vision with the world. Take advantage of this interest—your work is ready to shine!</p>
<p>— The Fublis team</p>
</div>
<div class="mb-3">
<p><x-mail::button :url="$upgradeUrl">Approve Request</x-mail::button></p>
</div>
@endif
@endsection
