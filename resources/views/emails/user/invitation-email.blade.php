@extends('emails.layouts.master')

@section('body')
<p style="margin-bottom: 10px;">Hi {{ $inviteColleague->name }},</p>
<p style="margin-bottom: 10px;">{{ $inviteColleague->user->name }} has invited you to join the network on <a href="{{ env('APP_URL') }}" class="text-dark" style="font-weight: bold;">Fublis</a>.</p>
<p>{{ $inviteColleague->message }}</p>
<x-mail::button :url="$invitationUrl">Accept the invite</x-mail::button>
@endsection
