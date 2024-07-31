<!DOCTYPE html>
<html>
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
	<title>{{ $title }}</title>
	<style type="text/css">
		@page {
            margin: 0cm 0cm;
        }

		*{
			font-family: 'Inter', sans-serif !important;
		}

		body{
			font-size: 14px;
			margin-top: 3cm;
			margin-left: 1.2cm;
			margin-right: 1.2cm;
			margin-bottom: 2.5cm;
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
			color: rgb(108, 117, 125);
			left: 1.2cm;
			right: 1.2cm;
			margin: 0;
		}
		header {
			top: 1cm;
		}

		header table{
			border-bottom: 2px solid rgb(108, 117, 125);
			padding-bottom: 10px;
		}

		header table td, footer table td{
			vertical-align: top;
			padding: 0 !important;
			margin: 0 !important;
		}

		footer {
			bottom: 0.5cm;
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
				<td style="text-align: right;">
					&copy; {{ date("Y") . ' ' . env('COMPANY_NAME') }} | <a href="https://www.fublis.com">www.fublis.com</a>
				</td>
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
