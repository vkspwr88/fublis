<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>{{ str()->headline($mediaKit->story->title) }}</title>
	<style>
		body{
			font-family: 'Inter', sans-serif !important;
			font-size: 15px;
		}
		table{
			width: 100%;
		}
		table, th, td {
			border: 1px solid #111;
			border-collapse: collapse;
		}
		tr th, tr td{
			padding: 10px 5px;
			text-align: left;
			vertical-align: top;
			margin: 0;
		}
		tr th{
			white-space: nowrap;
		}
	</style>
</head>
<body>
	<table class="table">
		<tr>
			<th>Media Kit Type</th>
			<td>Press Release</td>
		</tr>
		<tr>
			<th>Title</th>
			<td>{{ str()->headline($mediaKit->story->title) }}</td>
		</tr>
		<tr>
			<th>Company</th>
			<td>{{ $mediaKit->architect->company->name }}</td>
		</tr>
		<tr>
			<th>Company Website</th>
			<td></td>
		</tr>
		<tr>
			<th>Category</th>
			<td>{{ $mediaKit->category->name }}</td>
		</tr>
		<tr>
			<th>Image Credits</th>
			<td>{{ $mediaKit->story->image_credits }}</td>
		</tr>
		<tr>
			<th>Concept Note</th>
			<td>{{ $mediaKit->story->concept_note }}</td>
		</tr>
		<tr>
			<th>Write Up</th>
			<td>{!! $mediaKit->story->press_release_writeup !!}</td>
		</tr>
		<tr>
			<th></th>
			<td></td>
		</tr>
		<tr>
			<th></th>
			<td></td>
		</tr>
		<tr>
			<th></th>
			<td></td>
		</tr>
		<tr>
			<th></th>
			<td></td>
		</tr>
		<tr>
			<th></th>
			<td></td>
		</tr>
		<tr>
			<th></th>
			<td></td>
		</tr>
		<tr>
			<th></th>
			<td></td>
		</tr>
		<tr>
			<th></th>
			<td></td>
		</tr>
		<tr>
			<th></th>
			<td></td>
		</tr>
	</table>
</body>
</html>
