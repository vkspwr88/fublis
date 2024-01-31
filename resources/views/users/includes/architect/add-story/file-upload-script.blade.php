<script>
	function fileUpload(element) {
		return {
			isDropping: false,
			isUploading: false,
			progress: 0,
			image_ratio: null,
			handleCropFileSelect(event) {
				var files = event.target.files;
				if (files && files.length > 0){
					this.handleCropStart(files[0]);
				}
			},
			handleFileSelect(event) {
				if (event.target.files.length) {
					this.uploadFile(event.target.files[0])
				}
			},
			handleCropFileDrop(event) {
				if (event.dataTransfer.files.length > 0) {
					this.handleCropStart(event.dataTransfer.files[0]);
				}
			},
			handleFileDrop(event) {
				if (event.dataTransfer.files.length > 0) {
					this.uploadFile(event.dataTransfer.files[0]);
				}
			},
			handleCropStart(file){
				var done = function (url) {
					image.src = url;
					$modal.modal('show');
				};

				var reader;
				var url;

				if (URL) {
					done(URL.createObjectURL(file));
				} else if (FileReader) {
					reader = new FileReader();
					reader.onload = function (e) {
						done(reader.result);
					};
					reader.readAsDataURL(file);
				}
			},
			cropFile(event) {
				const $this = this;

				canvas = cropper.getCroppedCanvas({
					maxWidth: 800,
					maxHeight: 400,
					imageSmoothingQuality: 'high',
				});

				canvas.toBlob(function(blob) {
					url = URL.createObjectURL(blob);
					var reader = new FileReader();
					reader.readAsDataURL(blob);
					const newFile = new File([blob], 'cropped', {
						type: blob.type,
					});
					$this.uploadFile(newFile);
					$("#modal").modal('toggle');
				});
			},
			uploadFile(file) {
				const $this = this
				this.isUploading = true
				@this.upload(element, file,
					function (success) {  //upload was a success and was finished
						$this.isUploading = false
						$this.progress = 0
					},
					function(error) {  //an error occured
						console.log('error', error)
					},
					function (event) {  //upload progress was made
						// console.log('progress', event.detail.progress);
						$this.progress = event.detail.progress
					}
				)
			},
			handleFilesSelect(event) {
				// console.log('uploading multiple');
				if (event.target.files.length) {
					this.uploadFiles(event.target.files)
				}
			},
			handleFilesDrop(event) {
				if (event.dataTransfer.files.length > 0) {
					this.uploadFiles(event.dataTransfer.files)
				}
			},
			uploadFiles(files) {
				const $this = this;
				this.isUploading = true;
				// const selector = document.querySelector('#' + element);
				// const filesList = [...selector.files, files];
				// let images = Livewire.all()[0].snapshot.data[element][0];
				// console.log('old images', images);
				@this.uploadMultiple(element, files,
					function (success) {  //upload was a success and was finished
						$this.isUploading = false;
						$this.progress = 0;
						// let newImages = Livewire.all()[0].snapshot.data[element][0];
						// console.log('new images', newImages);
						// Livewire.all()[0].snapshot.data[element][0] = images.concat(newImages);
						// console.log('merged images', Livewire.all()[0].snapshot.data[element]);
					},
					function(error) {  //an error occured
						console.log('error', error)
					},
					function (event) {  //upload progress was made
						// console.log('progress', event.detail.progress);
						$this.progress = event.detail.progress;
					}
				)
			},
			removeUpload(filename) {
				@this.removeUpload(element, filename)
			},
		};
	}

	/* const trixEditor = document.getElementById('inputPressReleaseWrite');
	addEventListener("trix-blur", (event)=>{
		@this.set('pressReleaseWrite', trixEditor.getAttribute('value'));
	})

	const trixEditorElement = document.querySelector("trix-editor") */
</script>
