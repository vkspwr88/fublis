<!DOCTYPE html>
<html lang="en">
<head>
    <title>Test email</title>
	<link href="https://fonts.googleapis.com/css2?family=Inter" rel="stylesheet">
	<style>
		body{
			padding: 30px;
			margin: 0;
			font-family: 'Inter', sans-serif !important;
  			font-size: 15px;
		}
		p{
			margin: 0;
		}
		a{
			text-decoration: none;
		}
		.link{
			color: #6941C6;
		}
		.btn{
			background: #7F56D9;
			padding: 10px 14px;
			color: #fff;
			border-radius: 5px;
		}
	</style>
</head>
<body>
	<p style="margin-bottom: 30px;">
		<img src="{{ url(env('COMPANY_LOGO')) }}" alt="{{ env('COMPANY_NAME') }}" style="width: 150px;" />
	</p>
	<div style="padding: 40px 0;">
		@yield('body')
	</div>
	<p style="margin-bottom: 50px;">
		Thanks,<br>
		The Team
	</p>
	<p style="margin-bottom: 20px;">
		This email was sent to xxxx@xxx.xxx. If you'd rather not receive this kind of email, you can <a href="#" class="link">unsubscribe</a> or <a href="#" class="link">manage your email preferences</a>.
	</p>
	<p style="margin-bottom: 40px;">
		&copy; {{ date('Y') }} XXXXXX, 100 XXXXXX XXXXXX, XXXXXX 1111111
	</p>
	<p style="float: left;">
		<img src="{{ url(env('COMPANY_LOGO')) }}" alt="{{ env('COMPANY_NAME') }}" style="width: 150px;" />
	</p>
	<p style="float: right; margin-top: 10px;">
		<a href="#"><img src="{{ asset('images/social/tw.png') }}" alt="twitter" style="width: 25px; height: 25px; margin-right: 10px;"></a>
		<a href="#"><img src="{{ asset('images/social/fb.png') }}" alt="facebook" style="width: 25px; height: 25px; margin-right: 10px;"></a>
		<a href="#"><img src="{{ asset('images/social/in.png') }}" alt="instagram" style="width: 25px; height: 25px;"></a>
	</p>
</body>
</html>
