<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{ $title }}</title>
	<style>
		@page {
            margin: 100px 45px;
        }

		body{
			font-family: 'Inter', sans-serif !important;
			font-size: 14px;
		}

		a{
			text-decoration: none;
			color: inherit;
		}

		.logo{
			width: 120px;
		}

		header, footer{
			position: fixed;
			width: 100%;
			color: rgb(108, 117, 125);
			left: 0px;
			right: 0px;
		}
		header {
			top: -70px;
		}

		header table{
			border-bottom: 2px solid rgb(108, 117, 125);
			padding-bottom: 10px;
		}

		header table td, footer table td{
			vertical-align: top;
		}

		footer {
			bottom: -80px;
		}
		footer table{
			border-top: 2px solid rgb(108, 117, 125);
			padding-top: 20px;
		}

		table{
			width: 100%;
		}
		th, td{
			vertical-align: middle;
		}
		table.table, table.table th, table.table td {
			border: 1px solid #111;
			border-collapse: collapse;
		}
		table.table tr th, table.table tr td{
			padding: 10px 5px;
			text-align: left;
			vertical-align: top;
			margin: 0;
		}
		table.table tr th{
			white-space: nowrap;
		}
	</style>
	@stack('styles')
</head>
<body>
	<header>
		<table>
			<tr>
				<td>
					<a class="navbar-brand" href="{{ route('home') }}">
						<img src="{{ asset(env('COMPANY_LOGO')) }}" alt="{{ env('APP_NAME') }}" class="logo">
					</a>
				</td>
				<td style="text-align: right;">Your Gateway to Fresh, Ready-to-Publish Stories</td>
			</tr>
		</table>
	</header>

	<footer>
		<table>
			<tr>
				<td>
					<a class="navbar-brand" href="{{ route('home') }}">
						<img src="{{ asset(env('COMPANY_LOGO')) }}" alt="{{ env('APP_NAME') }}" class="logo">
					</a>
				</td>
				<td style="text-align: right;">&copy; {{ date("Y") }} {{ env('COMPANY_NAME') }} | <a href="{{ env('APP_URL') }}">{{ trimWebsiteUrl(env('APP_URL')) }}</a></td>
			</tr>
		</table>
	</footer>

	<main>
		<h2>{{ $title }}</h2>

		<h4>Fact File</h4>

		@yield('content')
	</main>

</body>
</html>
