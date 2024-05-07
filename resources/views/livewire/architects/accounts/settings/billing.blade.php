<div class="py-4">
	@if($isPaymentMethodOpen)
		<div class="row">
			<div class="col">
				<h4 class="p-0 m-0 text-dark fs-6 fw-semibold">Payment Method</h4>
				<p class="p-0 m-0 text-secondary fs-6">
					<small>Update your billing details.</small>
				</p>
			</div>
		</div>
		<hr>
		<form id="paymentMethodForm" wire:submit="updatePaymentMethod">
			<div class="row">
				<div class="col">
					<div class="form-group">
						<div id="payment-element"></div>
					</div>
				</div>
			</div>
			<hr>
			<div class="row">
				<div class="col">
					<input type="hidden" wire:model="dataSecret">
					<button id="card-button" class="btn btn-primary fw-medium" data-secret="{{ $dataSecret }}">
						Update Payment Method <x-users.spinners.primary-btn wire:target="updatePaymentMethod" />
					</button>
					<button type="button" class="btn btn-white text-dark" wire:click="closePaymentMethodForm">
						Cancel <x-users.spinners.primary-btn wire:target="closePaymentMethodForm" />
					</button>
				</div>
			</div>
		</form>
		<script src="https://js.stripe.com/v3/"></script>
		<script>
			const stripe = Stripe('{{ env('STRIPE_KEY') }}');
			const clientSecret = '{{ $dataSecret }}';
			const appearance = { };
			const options = {
				layout: {
					type: 'tabs',
				},
				paymentMethodOrder: ['card'],
				business: {
					name: '{{ env('COMPANY_NAME') }}'
				}
			};
			const elements = stripe.elements({ clientSecret, appearance });
			const paymentElement = elements.create('payment', options);
			paymentElement.mount('#payment-element');

			const cardButton = document.getElementById('card-button');
			const form = document.getElementById('paymentMethodForm');

			let formSubmit = false;

			cardButton.addEventListener('click', async (e) => {
				e.preventDefault();
				cardButton.disabled = true;
				formSubmit = true;
				const { setupIntent, error } = await stripe.confirmSetup({
					elements,
					redirect: 'if_required',
				});

				if (error) {
					// Display "error.message" to the user...
					console.log('Error:', error);
					cardButton.disabled = false;
					formSubmit = false;

					showAlert({
						'type' : 'error',
						'message' : error.message
					});
					/* let message = '';
					for (const key in error) {
						if (Object.hasOwnProperty.call(error, key)) {
							const element = error[key];
							console.log(key, element);
						}
					} */
				} else {
					// The card has been verified successfully...
					console.log('Verified');
					let token = document.createElement('input')
					token.setAttribute('type', 'hidden')
					token.setAttribute('name', 'token')
					token.setAttribute('wire:model', 'paymentToken')
					token.setAttribute('value', setupIntent.payment_method)
					form.appendChild(token)
					form.submit();
				}
			});
		</script>
	@else
		<div class="pb-4 row">
			<div class="col">
				<h4 class="p-0 m-0 text-dark fs-6 fw-semibold">Billing</h4>
				<p class="p-0 m-0 text-secondary fs-6">
					<small>Manage your billing details here.</small>
				</p>
			</div>
		</div>

		<div class="pb-5 row g-4">
			<div class="col-md-6">
				<div class="bg-white border-0 shadow card h-100">
					<div class="card-body">
						<div class="row g-4">
							<div class="col-12">
								<div class="row g-4 align-items-end">
									<div class="col-sm">
										<h4 class="m-0 fs-5 text-dark fw-medium">{{ $planName }}</h4>
										<p class="m-0 fs-6 text-secondary"><small>Our most popular plan for small teams.</small></p>
									</div>
									<div class="col-sm-auto text-end">
										<h2 class="m-0">
											<span class="text-dark fs-2 fw-bold">${{ $pricePerMonth }}</span>
											<span class="text-secondary fs-6 small">per month</span>
										</h2>
									</div>
								</div>
							</div>
							<div class="col-12">
								<p class="mb-2 text-dark fw-semibold">{{ $userCount }} of {{ $allowedTotalUser }} users</p>
								<div class="progress" role="progressbar" aria-label="Basic example" aria-valuenow="{{ $progress }}" aria-valuemin="0" aria-valuemax="100" style="height: 10px;">
									<div class="progress-bar bg-primary" style="width: {{ $progress }}%"></div>
								</div>
							</div>
						</div>
					</div>
					<div class="py-3 bg-white card-footer text-end">
						<a href="{{ route('pricing') }}" class="text-purple-700 fw-semibold">Upgrade plan <i class="bi bi-arrow-up-right"></i></a>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="bg-white border-0 shadow card h-100">
					<div class="card-body">
						<div class="row g-4">
							<div class="col-12">
								<h4 class="m-0 fs-5 text-dark fw-medium">Payment method</h4>
								<p class="m-0 fs-6 text-secondary"><small>Change how you pay for your plan.</small></p>
							</div>
							@if($paymentMethod)
								<div class="col-12">
									<div class="p-3 border rounded-2">
										<div class="row g-3">
											<div class="col-auto">
												<span class="py-3 btn btn-white text-dark">
													<img src="{{ asset('images/icons/payments/' . $paymentMethod->card->display_brand . '.png') }}" alt="{{ $paymentMethod->card->display_brand }}" class="img-fluid" />
												</span>
											</div>
											<div class="col text-secondary">
												<p class="m-0 fs-6 fw-medium text-dark">
													{{ ucfirst($paymentMethod->card->display_brand) }} ending in {{ $paymentMethod->card->last4 }}
												</p>
												<p class="mb-2 fs-6 fw-normal">Expiry {{ sprintf('%02d', $paymentMethod->card->exp_month) }}/{{ $paymentMethod->card->exp_year }}</p>
												@if($paymentMethod->billing_details->email)
													<p class="m-0 fs-6 fw-normal"><i class="bi bi-envelope"></i> {{ $paymentMethod->billing_details->email }}</p>
												@endif
											</div>
											<div class="col-auto text-end">
												<button type="button" class="btn btn-white text-dark" wire:click="openPaymentMethodForm">
													Edit <x-users.spinners.primary-btn wire:target="openPaymentMethodForm" />
												</button>
											</div>
										</div>
									</div>
								</div>
							@else
								<div class="col-12">
									<button type="button" class="btn btn-white text-dark" wire:click="openPaymentMethodForm">
										Add Payment Method <x-users.spinners.primary-btn wire:target="openPaymentMethodForm" />
									</button>
								</div>
							@endif
						</div>
					</div>
				</div>
			</div>
		</div>

		<div class="row g-4">
			<div class="col-12">
				<h4 class="p-0 m-0 text-dark fs-6 fw-semibold">Billing and invoicing</h4>
				<p class="p-0 m-0 text-secondary fs-6">
					<small>Pick an account plan that fits your workflow</small>
				</p>
			</div>
			<div class="col-12">
				<div class="bg-white border-0 shadow card">
					<div class="table-responsive rounded-2">
						<table class="table p-0 m-0 align-middle" style="white-space: nowrap;">
							<thead class="table-light">
								<tr>
									<th class="p-3 text-secondary small">Invoice</th>
									<th class="p-3 text-secondary small">Billing date</th>
									<th class="p-3 text-secondary small">Status</th>
									<th class="p-3 text-secondary small">Amount</th>
									<th class="p-3 text-secondary small">Plan</th>
									<th class="p-3 text-secondary small"></th>
								</tr>
							</thead>
							<tbody>
								@forelse ($invoices as $invoice)
									{{-- {{ dd($invoice); }} --}}
									<tr>
										<td class="p-3 small">
											<div class="d-flex align-items-center">
												<x-users.icons.purple-circle iconHTML='<i class="bi bi-file-earmark"></i>' />
												<span class="ms-2 text-dark fw-semibold">{{ $invoice->number }}</span>
											</div>
										</td>
										<td class="p-3 small text-secondary">{{ $invoice->date()->toFormattedDateString() }}</td>
										<td class="p-3 small">
											@if ($invoice->status == "paid")
												<span class="badge rounded-pill bg-success bg-opacity-10 text-success small"><i class="bi bi-check"></i> Paid</span>
											@else
												{{ $invoice->status }}
											@endif
										</td>
										<td class="p-3 small text-secondary">USD {{ $invoice->total() }}</td>
										<td class="p-3 small text-secondary">{{ $invoice->subscription_details->metadata->plan ?? '' }}</td>
										<td class="p-3 small">
											<a href="{{ route('architect.stripe.invoice.download', ['invoice' => $invoice->id]) }}" class="text-purple-700 fw-semibold">Download</a>
										</td>
									</tr>
								@empty
									<tr>
										<th class="text-center text-danger" colspan="6">No invoice record is there</th>
									</tr>
								@endforelse
							</tbody>
						</table>
					</div>
				</div>
			</div>
		</div>
	@endif
</div>
