@extends('emails.layouts.master')

@section('body')
<h2 style="font-size: 30px;">New Media Kits Available on Fublis!</h2>
<p class="mb-3">Hi {{ $name }},</p>
<p>I hope this email finds you well. We are thrilled to inform you that new media kits are now available on Fublis, for you to download and publish. These stories are fresh, compelling, and meticulously crafted to provide you with all the information you need.</p>
<hr style="width: 96px; margin: 15px 0; color: #EAECF0; height: 1px;">
<div>
<p class="mb-3">Preview of Media Kits:</p>
@foreach ($mediaKits as $mediaKit)
<p><img src="{{ Storage::url($mediaKit['cover_image_path']) }}" alt="Cover" height="100" width="200"> <strong>{{ $mediaKit['title'] }}</strong></p>
@endforeach
</div>
<div class="mb-3">
<p><a href="{{ $loginUrl }}" class="link" style="text-decoration: underline;">Log in to check for new media kits →</a></p>
<p>We believe these new stories will greatly enrich your publication and engage your audience. Log in now to explore and download the latest content available on Fublis.</p>
<p><x-mail::button :url="$mediaKitsUrl">Media Kits</x-mail::button></p>
</div>
@endsection
