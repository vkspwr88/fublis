@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	@include('users.includes.architect.setting-breadcrumb')

	@include('users.includes.architect.setting-header')

	<hr class="border-gray-300 my-4">

	@include('users.includes.architect.setting-nav', ['setting' => 'Billing'])

	<div class="row py-4">
		<div class="col">
			<h4 class="text-dark fs-6 fw-semibold m-0 p-0">Billing</h4>
			<p class="text-secondary fs-6 m-0 p-0">
				<small>Manage your billing details here.</small>
			</p>
		</div>
	</div>

	<div class="row g-4">
		<div class="col-md-6">
			<div class="card bg-white shadow border-0 h-100">
				<div class="card-body">
					<div class="row g-4">
						<div class="col-12">
							<div class="row g-4 align-items-end">
								<div class="col-sm">
									<h4 class="fs-5 text-dark m-0 fw-medium">Basic plan</h4>
									<p class="fs-6 text-secondary m-0"><small>Our most popular plan for small teams.</small></p>
								</div>
								<div class="col-sm-auto text-end">
									<h2 class="m-0">
										<span class="text-dark fs-2 fw-bold">$10</span>
										<span class="text-secondary fs-6 small">per month</span>
									</h2>
								</div>
							</div>
						</div>
						<div class="col-12">
							<p class="text-dark fw-semibold mb-2">14 of 20 users</p>
							<div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" style="height: 10px;">
								<div class="progress-bar bg-primary" style="width: 25%"></div>
							</div>
						</div>
					</div>
				</div>
				<div class="card-footer text-end bg-white py-3">
					<a href="javascript:;" class="text-purple-700 fw-semibold">Upgrade plan <i class="bi bi-arrow-up-right"></i></a>
				</div>
			</div>
		</div>
		<div class="col-md-6">
			<div class="card bg-white shadow border-0 h-100">
				<div class="card-body">
					<div class="row g-4">
						<div class="col-12">
							<h4 class="fs-5 text-dark m-0 fw-medium">Payment method</h4>
							<p class="fs-6 text-secondary m-0"><small>Change how you pay for your plan.</small></p>
						</div>
						@if($paymentMethod)
							<div class="col-12">
								<div class="p-3 border rounded-2">
									<div class="row g-3">
										{{-- <div class="col-auto">
											<button type="button" class="btn btn-white text-dark">VISA</button>
										</div> --}}
										<div class="col text-secondary">
											<p class="fs-6 fw-medium m-0 text-dark">{{ ucfirst($paymentMethod->card->display_brand) }} ending in {{ $paymentMethod->card->last4 }}</p>
											<p class="fs-6 fw-normal mb-2">Expiry {{ sprintf('%02d', $paymentMethod->card->exp_month) }}/{{ $paymentMethod->card->exp_year }}</p>
											<p class="fs-6 fw-normal m-0"><i class="bi bi-envelope"></i> {{ $paymentMethod->billing_details->email }}</p>
										</div>
										<div class="col-auto text-end">
											<button type="button" class="btn btn-white text-dark">Edit</button>
										</div>
									</div>
								</div>
							</div>
						@endif
					</div>
				</div>
			</div>
		</div>
	</div>

	<div class="row pt-5 g-4">
		<div class="col-12">
			<h4 class="text-dark fs-6 fw-semibold m-0 p-0">Billing and invoicing</h4>
			<p class="text-secondary fs-6 m-0 p-0">
				<small>Pick an account plan that fits your workflow</small>
			</p>
		</div>
		<div class="col-12">
			<div class="card bg-white shadow border-0">
				<div class="table-responsive rounded-2">
					<table class="table align-middle m-0 p-0" style="white-space: nowrap;">
						<thead class="table-light">
							<tr>
								<th class="text-secondary small p-3">Invoice</th>
								<th class="text-secondary small p-3">Billing date</th>
								<th class="text-secondary small p-3">Status</th>
								<th class="text-secondary small p-3">Amount</th>
								<th class="text-secondary small p-3">Plan</th>
								<th class="text-secondary small p-3"></th>
							</tr>
						</thead>
						<tbody>
							@foreach ($invoices as $invoice)
								<tr>
									<td class="small p-3">
										<div class="d-flex align-items-center">
											<x-users.icons.purple-circle iconHTML='<i class="bi bi-file-earmark"></i>' />
											<span class="ms-2 text-dark fw-semibold">{{ $invoice->number }}</span>
										</div>										
									</td>
									<td class="small p-3 text-secondary">{{ $invoice->date()->toFormattedDateString() }}</td>
									<td class="small p-3">
										@if ($invoice->status == "paid")
											<span class="badge rounded-pill bg-success bg-opacity-10 text-success small"><i class="bi bi-check"></i> Paid</span>
										@else
											{{ $invoice->status }}
										@endif
									</td>
									<td class="small p-3 text-secondary">USD {{ $invoice->total() }}</td>
									<td class="small p-3 text-secondary">{{ $invoice->metadata->plan ?? '' }}</td>
									<td class="small p-3">
										<a href="{{ route('architect.stripe.invoice.download', ['invoice' => $invoice->id]) }}" class="text-purple-700 fw-semibold">Download</a>
									</td>
								</tr>
							@endforeach
						</tbody>						
					</table>
				</div>
			</div>
			
		</div>
	</div>
</div>
@endsection
