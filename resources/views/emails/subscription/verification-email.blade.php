@extends('emails.layouts.master')

@section('body')
<p>Hi Subscriber,</p>
<p>Click on verification link to verify your email address:</p>
<x-mail::button :url="$verificationUrl">
Verify email
</x-mail::button>
@endsection
