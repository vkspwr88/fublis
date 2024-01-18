@extends('emails.layouts.master')

@section('body')
<p class="mb-3">Hi {{ $guest->name }},</p>
<p class="mb-3">This is your verification code:</p>
<div class="mb-3">
<p class="otp-box"><span>{{ $otp[0] }}</span></p>
<p class="otp-box"><span>{{ $otp[1] }}</span></p>
<p class="otp-box"><span>{{ $otp[2] }}</span></p>
<p class="otp-box" style="margin-right: 0;"><span>{{ $otp[3] }}</span></p>
</div>
<p>This code will only be valid for the next {{ $emailVerificationTimeout }} minutes.{{-- If the code does not work, you can use this login verification link: --}}</p>
@endsection
