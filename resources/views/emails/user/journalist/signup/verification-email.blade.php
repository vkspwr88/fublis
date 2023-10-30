@extends('emails.layouts.master')

@section('body')
<p style="margin-bottom: 20px;">Hi {{ $guest->name }},</p>
<p style="margin-bottom: 10px;">This is your verification code:</p>
<div style="margin-bottom: 10px;">
<p class="otp-box" style="width: 4rem; height: 4rem; line-height: 3.5rem; padding: 0;">{{ $otp[0] }}</p>
<p class="otp-box" style="width: 4rem; height: 4rem; line-height: 3.5rem; padding: 0;">{{ $otp[1] }}</p>
<p class="otp-box" style="width: 4rem; height: 4rem; line-height: 3.5rem; padding: 0;">{{ $otp[2] }}</p>
<p class="otp-box" style="width: 4rem; height: 4rem; line-height: 3.5rem; padding: 0;">{{ $otp[3] }}</p>
</div>
<p>This code will only be valid for the next {{ $emailVerificationTimeout }} minutes.{{-- If the code does not work, you can use this login verification link: --}}</p>
@endsection
