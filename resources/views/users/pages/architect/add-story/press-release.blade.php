@extends('users.layouts.master')

{!! seo() !!}

@section('body')
<div class="container py-5">
	@include('users.includes.architect.add-story-steps')

	<div class="row justify-content-center pt-5">
		<div class="col-md-11">
			<h4 class="text-purple-600 fs-3 fw-semibold m-0 py-2">Submit Press Release</h4>
			<form action="" class="pt-4">
				<div class="row">
					<div class="col-md-4">
						<label for="inputText" class="col-form-label text-dark fs-6 fw-medium">Cover Image</label>
						<label class="d-block form-text text-secondary fs-7 m-0">This will be displayed on your media kit.</label>
					</div>
					<div class="col-md-8">
						<div class="card">
							<div class="card-body bg-white rounded-3 border border-1 border-light">
								<div class="row align-items-center">
									<div class="col-12">
										<div class="d-flex justify-content-center align-items-center">
											<div class="upload-icon rounded-circle text-gray-600 fs-5">
												<i class="bi bi-cloud-upload"></i>
											</div>
										</div>
										<p class="card-text text-center text-secondary fs-6 m-0 py-2">
											<span class="text-purple-700 fw-semibold">Click to upload</span> or drag and drop
										</p>
										<p class="card-text text-center text-secondary fs-6 m-0 py-2">SVG, PNG, JPG or GIF (max. 800x400px)</p>
									</div>
								</div>
							</div>
						</div>
					</div>
				</div>
				<hr class="border-gray-300">
				<div class="row mb-3">
					<label for="inputText" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Press Release Title</label>
					<div class="col-md-8">
						<input type="text" id="inputText" class="form-control">
					</div>
				</div>
				<div class="row mb-3">
					<label for="inputText" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Image Credits</label>
					<div class="col-md-8">
						<input type="text" id="inputText" class="form-control">
					</div>
				</div>
				<div class="row mb-3">
					<label for="inputText" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Category</label>
					<div class="col-md-8">
						<select id="inputText" class="form-select">
							<option selected>Choose...</option>
							<option value="1">One</option>
							<option value="2">Two</option>
							<option value="3">Three</option>
						</select>
					</div>
				</div>
				<div class="row mb-3">
					<div class="col-md-4">
						<label for="inputText" class="col-form-label text-dark fs-6 fw-medium">Add Concept Note</label>
						<label class="d-block form-text text-secondary fs-7 m-0">Write in 50-75 words (this text will be used in pitch to journalists)</label>
					</div>
					<div class="col-md-8">
						<textarea id="inputText" class="form-control" rows="6"></textarea>
						<div id="emailHelp" class="form-text">275 characters left</div>
					</div>
				</div>
				<div class="row">
					<div class="col-md-4">
						<label for="inputText" class="col-form-label text-dark fs-6 fw-medium">Write Press Release</label>
						<label class="d-block form-text text-secondary fs-7 m-0">Add the text in 300-500 words</label>
					</div>
					<div class="col-md-8">
						<textarea id="inputText" class="form-control" rows="8"></textarea>
					</div>
				</div>
				<hr class="border-gray-300">
				<div class="row">
					<div class="col-md-4">
						<label for="inputText" class="col-form-label text-dark fs-6 fw-medium">Upload Press Release</label>
						<label class="d-block form-text text-secondary fs-7 m-0">Add the file as Word document/PDF</label>
					</div>
					<div class="col-md-8">
						<div class="card mb-2">
							<div class="card-body bg-white rounded-3 border border-1 border-light">
								<div class="row align-items-center">
									<div class="col-12">
										<div class="d-flex justify-content-center align-items-center">
											<div class="upload-icon rounded-circle text-gray-600 fs-5">
												<i class="bi bi-cloud-upload"></i>
											</div>
										</div>
										<p class="card-text text-center text-purple-700 fw-semibold fs-6 m-0 py-2">Click to upload</p>
									</div>
								</div>
							</div>
						</div>
						<div class="input-group">
							<span class="input-group-text bg-white" id="basic-addon1">http://</span>
							<input type="text" class="form-control" placeholder="Insert drive link" aria-describedby="basic-addon1">
						</div>
					</div>
				</div>
				<hr class="border-gray-300">
				<div class="row">
					<div class="col-md-4">
						<label for="inputText" class="col-form-label text-dark fs-6 fw-medium">Upload Photographs</label>
						<label class="d-block form-text text-secondary fs-7 m-0">Choose the best high-resolution images</label>
					</div>
					<div class="col-md-8">
						<div class="row mb-2 align-items-center">
							<div class="col-md-4">
								<div class="card">
									<div class="card-body bg-white rounded-3 border border-1 border-light">
										<div class="row align-items-center">
											<div class="col-12">
												<div class="d-flex justify-content-center align-items-center">
													<div class="upload-icon rounded-circle text-gray-600 fs-5">
														<i class="bi bi-cloud-upload"></i>
													</div>
												</div>
												<p class="card-text text-center text-purple-700 fw-semibold fs-6 m-0 py-2">Click to upload</p>
											</div>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="d-flex flex-column justify-content-center align-items-center">
									<div class="text-center fs-1 rounded-circle bg-white" style="color: #9E9E9E;"><i class="bi bi-plus"></i></div>
									<p class="text-center text-gray-600 fs-6 m-0 py-2">Add more</p>
								</div>
							</div>
						</div>
						<div class="input-group">
							<span class="input-group-text bg-white" id="basic-addon1">http://</span>
							<input type="text" class="form-control" placeholder="Insert drive link" aria-describedby="basic-addon1">
						</div>
					</div>
				</div>
				<hr class="border-gray-300">
				<div class="row">
					<label for="inputText" class="col-md-4 col-form-label text-dark fs-6 fw-medium">Tags</label>
					<div class="col-md-8">
						<input type="text" id="inputText" class="form-control">
					</div>
				</div>
				<hr class="border-gray-300">
				<div class="text-end">
					<button class="btn btn-white fs-6 fw-semibold" type="button">Preview</button>
					<button class="btn btn-primary fs-6 fw-semibold" type="button">Submit Press Release</button>
				</div>
			</form>
		</div>
	</div>

	<div class="row justify-content-center pt-5">
		<div class="col-md-10">
			<div class="card rounded-4 shadow border border-1">
				<div class="row justify-content-between align-items-center">
					<div class="col-12">
						<div class="row justify-content-center">
							<div class="col-md-10">
								<div class="card-body p-5 text-center">
									<h5 class="card-title text-purple-900 fs-1 fw-semibold m-0 py-3">Your story is live.<br>Pitch Now!</h5>
									<p class="card-text text-secondary fs-6 fw-normal m-0 py-3">Start exploring the publishing platforms readily available on Fublis. You can also respond to invited call for submissions that match your uploaded story.</p>
									<p class="card-text m-0 py-3">
										<button class="btn btn-primary btn-lg fs-6 fw-semibold" type="button">Pitch Story</button>
									</p>
								</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
@endsection
