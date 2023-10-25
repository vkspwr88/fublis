@extends('emails.layouts.master')

@section('body')
<p>Hi {{ $guest->name }},</p>
<p>This is your verification code:</p>
<div>
<p class="otp-box">{{ $otp[0] }}</p>
<p class="otp-box">{{ $otp[1] }}</p>
<p class="otp-box">{{ $otp[2] }}</p>
<p class="otp-box">{{ $otp[3] }}</p>
</div>
<p>This code will only be valid for the next {{ $emailVerificationTimeout }} minutes.{{-- If the code does not work, you can use this login verification link: --}}</p>
@endsection
