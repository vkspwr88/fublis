<x-mail::message>
<p style="margin-bottom: 30px;">
<img src="{{ url(env('COMPANY_EMAIL_LOGO')) }}" alt="{{ env('COMPANY_NAME') }}" style="width: 150px;" />
</p>
<div style="padding: 40px 0;">
@yield('body')
</div>
<p style="margin-bottom: 50px;">
Thanks,
<br>
The Team
</p>
<p style="margin-bottom: 20px; color: #98A2B3;">
<small>
This email was sent to <span class="link">{{ $senderEmail }}</span>. If you'd rather not receive this kind of email, you can <a href="#" class="link">unsubscribe</a> or <a href="#" class="link">manage your email preferences</a>.
</small>
</p>
<p style="margin-bottom: 40px;">
&copy; {{ date('Y') }} {{ env('COMPANY_ADDRESS') }}
</p>
<p style="float: left;">
<img src="{{ url(env('COMPANY_EMAIL_LOGO')) }}" alt="{{ env('COMPANY_NAME') }}" style="width: 150px;" />
</p>
<p style="float: right; margin-top: 10px;">
<a href="#"><img src="{{ asset('images/social/tw.png') }}" alt="twitter" style="width: 25px; height: 25px; margin-right: 10px;"></a>
<a href="#"><img src="{{ asset('images/social/fb.png') }}" alt="facebook" style="width: 25px; height: 25px; margin-right: 10px;"></a>
<a href="#"><img src="{{ asset('images/social/in.png') }}" alt="instagram" style="width: 25px; height: 25px;"></a>
</p>
</x-mail::message>
