@extends('emails.layouts.master')

@section('body')
<h2>Welcome to Fublis</h2>
<p>Hi {{ $guest->name }},</p>
<p>We're excited to welcome you to Fublis and we're even more excited about what we've got planned. You're already on your way to creating and pitching press releases, projects, and stories.</p>
<p>Whether you're here for your brand, for a project, or just for fun — welcome! If there's anything you need, we'll be here every step of the way.</p>
<hr>
<p><a href="{{ route('architect.add-story.index') }}" class="link" style="text-decoration: underline;">Create media kit →</a><br>Create media kits and start pitching your stories</p>
<hr>
<p><a href="{{ route('architect.add-story.index') }}" class="link" style="text-decoration: underline;">Follow us on Twitter →</a><br>Stay up-to-date with the latest announcements and jobs.</p>
<hr>
<p><a href="{{ route('architect.add-story.index') }}" class="link" style="text-decoration: underline;">Why we're building Fublis →</a><br>Fublis is a new standard of PR Communications and Project Pitches.</p>
<hr>
<p>Thanks for signing up. If you have any questions, send us a message at <a href="mailto:{{ env('COMPANY_EMAIL') }}" class="link">{{ env('COMPANY_EMAIL') }}</a> or on <a href="#" class="link">Twitter</a>. We'd love to hear from you.<br>— The team</p>
@endsection
