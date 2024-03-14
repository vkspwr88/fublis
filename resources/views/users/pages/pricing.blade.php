@extends('users.layouts.master')

{!! seo() !!}

@section('body')

<div class="px-0 py-5 text-white bg-purple-800 w-100">
    <div class="container">
        <div class="row">
            <div class="py-5 col">
                <h5 class="text-pink-200 fs-7">Pricing</h5>
                <div class="mb-4">
                    <h2 class="m-0 fw-bold">Start for free, choose a plan</h2>
                    <h2 class="m-0 fw-bold">when you are ready</h2>
                </div>
                <div class="mb-4 text-pink-200 fs-6">
                    <p class="m-0">Simple, transparent pricing that grows with you.</p>
                    <p class="m-0">Try our <span class="fw-medium">free plan</span> for 3 Pitches/month. <a class="text-pink-200 fw-medium" href="{{ route('architect.signup') }}">Sign Up Now</a>.</p>
                </div>
            </div>
        </div>
    </div>
</div>

<livewire:users.pricing.index />

<div class="py-5">
	<div class="container">
		<div class="row">
			<div class="col-md-8 offset-md-2">
				<div class="row g-4 text-center">
					<div class="col-12">
						<p class="m-0"><span class="text-purple-700 bg-purple-100 badge rounded-pill">Features</span></p>
					</div>
					<div class="col-12">
						<h2 class="m-0 fs-4 fw-bold">Cutting-edge features for advanced<br>PR & analytics</h2>
					</div>
					<div class="col-12">
						<p class="m-0">Powerful, self-serve tool and media kit analytics to help you pitch, engage, and be published gauranteed. Trusted by over 500 startups.</p>
					</div>
					<div class="col-12">
						<p class="m-0">
							<img src="{{ asset('images/pricing/pricing-features.png') }}" alt="..." class="border border-4 border-dark img-fluid rounded-3">
						</p>
					</div>
				</div>
			</div>
		</div>
		<div class="pt-5 row gy-5">
			<div class="col-md-4">
				<div class="bg-transparent border-0 card shadow-0">
					<div class="text-center card-body">
						<div class="row g-3">
							<div class="col-12">
								<x-users.icons.purple-circle iconHTML='<i class="bi bi-share"></i>' />
							</div>
							<div class="col-12">
								<h4 class="mb-2 fw-bold fs-5 text-dark">Ever Growing Network</h4>
								<p class="m-0 text-secondary">Our journalist network surged by 250% in the past year, now including major international publications. Expand your reach with Fublis.</p>
							</div>
							<div class="col-12">
								<p class="m-0"><a href="javascript:;" class="text-purple-700 fw-medium">Learn more <i class="bi bi-arrow-right"></i></a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="bg-transparent border-0 card shadow-0">
					<div class="text-center card-body">
						<div class="row g-3">
							<div class="col-12">
								<x-users.icons.purple-circle iconHTML='<i class="bi bi-lightning-charge"></i>' />
							</div>
							<div class="col-12">
								<h4 class="mb-2 fw-bold fs-5 text-dark">Publication Success Rate</h4>
								<p class="m-0 text-secondary">Experience an impressive 85% success rate: stories submitted through Fublis often lead to successful publications. Trust us to elevate your message effectively.</p>
							</div>
							<div class="col-12">
								<p class="m-0"><a href="javascript:;" class="text-purple-700 fw-medium">Learn more <i class="bi bi-arrow-right"></i></a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="bg-transparent border-0 card shadow-0">
					<div class="text-center card-body">
						<div class="row g-3">
							<div class="col-12">
								<x-users.icons.purple-circle iconHTML='<i class="bi bi-lightning-charge"></i>' />
							</div>
							<div class="col-12">
								<h4 class="mb-2 fw-bold fs-5 text-dark">Real-Time Analytics</h4>
								<p class="m-0 text-secondary">Track the performance of your press releases and media kits with real-time analytics. This data helps in understanding the effectiveness of your PR strategy and in making informed decisions.</p>
							</div>
							<div class="col-12">
								<p class="m-0"><a href="javascript:;" class="text-purple-700 fw-medium">Learn more <i class="bi bi-arrow-right"></i></a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="bg-transparent border-0 card shadow-0">
					<div class="text-center card-body">
						<div class="row g-3">
							<div class="col-12">
								<x-users.icons.purple-circle iconHTML='<i class="bi bi-lightning-charge"></i>' />
							</div>
							<div class="col-12">
								<h4 class="mb-2 fw-bold fs-5 text-dark">Unparalleled Connectivity</h4>
								<p class="m-0 text-secondary">Fublis is more than just a platform; it's a nexus that connects you with a global network of journalists, publishers, and media outlets. This ensures that your stories reach the right audience.</p>
							</div>
							<div class="col-12">
								<p class="m-0"><a href="javascript:;" class="text-purple-700 fw-medium">Learn more <i class="bi bi-arrow-right"></i></a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="bg-transparent border-0 card shadow-0">
					<div class="text-center card-body">
						<div class="row g-3">
							<div class="col-12">
								<x-users.icons.purple-circle iconHTML='<i class="bi bi-lightning-charge"></i>' />
							</div>
							<div class="col-12">
								<h4 class="mb-2 fw-bold fs-5 text-dark">Ready to Publish Media Kits</h4>
								<p class="m-0 text-secondary">Our platform stands out for its unique, ready-to-publish Media Kit format. Ensuring that they meet the specific needs and preferences of journalists and publishers.</p>
							</div>
							<div class="col-12">
								<p class="m-0"><a href="javascript:;" class="text-purple-700 fw-medium">Learn more <i class="bi bi-arrow-right"></i></a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-4">
				<div class="bg-transparent border-0 card shadow-0">
					<div class="text-center card-body">
						<div class="row g-3">
							<div class="col-12">
								<x-users.icons.purple-circle iconHTML='<i class="bi bi-lightning-charge"></i>' />
							</div>
							<div class="col-12">
								<h4 class="mb-2 fw-bold fs-5 text-dark">Resource-Rich Platform</h4>
								<p class="m-0 text-secondary">Fublis is not just about connecting and publishing; it's a resource hub. Our platform offers educational materials, tips, and guidelines on PR best practices, ensuring that you're always at the top of your game.</p>
							</div>
							<div class="col-12">
								<p class="m-0"><a href="javascript:;" class="text-purple-700 fw-medium">Learn more <i class="bi bi-arrow-right"></i></a></p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="py-5 bg-white">
	<div class="container">
		<div class="py-5 row g-4">
			<div class="col-md-6">
				<div class="row g-4">
					<div class="col-12">
						<h6 class="m-0 text-purple-700 fw-bold fs-7">New feature</h6>
					</div>
					<div class="col-12">
						<h3 class="m-0 fw-bold fs-4 text-dark">Introducing real time chat with journalists</h3>
					</div>
					<div class="col-12">
						<p class="m-0">With Fublis, you're not just sending out content into the void. The platform enables real-time interaction with journalists, allowing for immediate feedback, collaboration, and the opportunity to build lasting relationships within the media industry.</p>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row g-4">
					<div class="col-12">
						<div class="row">
							<div class="col-auto">
								<x-users.icons.purple-circle iconHTML='<i class="bi bi-lightning-charge"></i>' />
							</div>
							<div class="col">
								<h4 class="mb-2 fw-semibold text-dark fs-6">Efficient and Hassle-Free Experience</h4>
								<p class="m-0 text-secondary fs-6">Fublis streamlines the PR process, saving you time and resources. The platform's user-friendly interface allows for quick and easy uploads of content, making pitching to multiple journalists and publishers a breeze.</p>
							</div>
						</div>
					</div>
					<div class="col-12">
						<div class="row">
							<div class="col-auto">
								<x-users.icons.purple-circle iconHTML='<i class="bi bi-lightning-charge"></i>' />
							</div>
							<div class="col">
								<h4 class="mb-2 fw-semibold text-dark fs-6">Guaranteed Publication Opportunities</h4>
								<p class="m-0 text-secondary fs-6">One of the most significant advantages of using Fublis is the opportunity for guaranteed publication on various platforms. This feature provides a level of certainty and confidence that your stories will gain the exposure they deserve.</p>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<div class="py-5 row">
			<div class="col-md-8 offset-md-2">
				<img src="{{ asset('images/pricing/pricing-group.png') }}" alt="..." class="img-fluid">
			</div>
		</div>
	</div>
</div>
<div class="py-5">
	<div class="container">
		<div class="py-5 row g-4">
			<div class="col-md-6">
				<div class="row g-4">
					<div class="col-12">
						<h6 class="m-0 text-purple-700 fw-bold fs-7">Support</h6>
					</div>
					<div class="col-12">
						<h3 class="m-0 fw-bold fs-4 text-dark">FAQs</h3>
					</div>
					<div class="col-12">
						<p class="m-0">Everything you need to know about the product and billing. Can't find the answer you're looking for? Please chat to our friendly team or visit the help centre.</p>
					</div>
				</div>
			</div>
			<div class="col-md-6">
				<div class="row g-4">
					<div class="col-12">
						<div class="row">
							<div class="col">
								<h4 class="mb-2 fw-semibold text-dark fs-6">Is there a free trial available?</h4>
								<p class="m-0 text-secondary fs-6">Yes, you can try us for with free account with 3 Pitches every month on limited publications and journalists. It just takes 2 minutes to signup on Fublis and start pitching.</p>
							</div>
							<div class="col-auto">
								<span class="fs-5 text-muted"><i class="bi bi-dash-circle"></i></span>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<div class="px-0 py-5 text-white bg-purple-800 w-100">
    <div class="container">
        <div class="py-5 row g-4">
            <div class="col-md">
				<div class="row g-4">
					<div class="col-12">
						<h2 class="m-0 fw-bold">Start with your free account</h2>
					</div>
					<div class="col-12">
						<div class="text-pink-200 fs-6">
							<p class="m-0">Join over 500+ brands, start-ups, architects, designers & </p>
							<p class="m-0">PR professionals already growing with Fublis.</p>
						</div>
					</div>
					<div class="col-12">
						<div class="row g-3 row-cols-4">
							@for ($i=1; $i<=8; $i++)
								<div class="col-auto">
									<img src="{{ asset('images/pricing/Fictional company logo' . $i . '.png') }}" alt="...">
								</div>
							@endfor
						</div>
					</div>
				</div>
            </div>
			<div class="col-md-auto text-end">
				<a href="{{ route('architect.signup') }}" class="btn btn-white text-dark fw-semibold fs-6 border-white">Sign up Now</a>
				<a href="#" class="btn btn-primary fs-6 fw-semibold">Upgrade</a>
			</div>
        </div>
    </div>
</div>
@endsection
