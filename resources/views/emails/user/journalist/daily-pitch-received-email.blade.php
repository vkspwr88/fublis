@extends('emails.layouts.master')

@section('body')
<h2 style="font-size: 30px;">You've received new Pitches on Fublis!</h2>
<p class="mb-3">Hi {{ $name }},</p>
<p class="mb-3">I hope this email finds you well. We are excited to inform you that new pitches have been submitted to you on Fublis, offering a wealth of fresh and compelling stories ready for your publication.</p>
<div class="mb-3">
<p><a href="{{ $loginUrl }}" class="link" style="text-decoration: underline;">Log in to check for pitches received and new media kits →</a></p>
<p>Thank you for being a valued member of the Fublis community. We look forward to seeing the incredible stories you will create!</p>
<p><x-mail::button :url="$pitchesUrl">Check Pitches</x-mail::button></p>
</div>
@endsection
