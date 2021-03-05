$(document).ready(() => {
	var url			= window.location.href;
	var csrf_key	= $('.csrf').attr('name');
	var csrf_val	= $('.csrf').val();
	// $('.money').simpleMoneyFormat();


	const Toast		= Swal.mixin({
		toast: true,
		position: 'top-end',
		showConfirmButton: false,
		timer: 3000,
		timerProgressBar: true,
		didOpen: (toast) => {
			toast.addEventListener('mouseenter', Swal.stopTimer)
			toast.addEventListener('mouseleave', Swal.resumeTimer)
		}
	})


	// Single image preview

	function ekUpload() {
		//#region Single image preview
		$('.file-upload').on('change', function (e) {
			var files = e.target.files || e.dataTransfer.files;
			var file = files[0];
			if (file) {
				// var fileType = file.type;
				// console.log(fileType);
				var imageName = file.name;

				var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
				if (isGood) {
					$(this).next().find('.start').addClass('d-none');
					// $(this).next().find('.messages').removeClass('d-none').text(imageName);
					$(this).next().find('.file-image-preview').removeClass("d-none").attr('src', URL.createObjectURL(file));
				} else {
					$(this).next().find('.file-image-preview').addClass("d-none").attr('src', '#');
					$(this).next().find('.start').removeClass('d-none');
					// $(this).next().find('.messages').addClass('d-none');
					Toast.fire({
						icon: 'error',
						title: 'Vui lòng chọn file hợp lệ'
					});
					// document.getElementById("file-upload-form").reset();
				}
			}
			else {
				$(this).next().find('.file-image-preview').addClass("d-none").attr('src', '#');
				$(this).next().find('.start').removeClass('d-none');
				// $(this).next().find('.messages').addClass('d-none');
			}

		})
		//#endregion

		//#region Drag file
		var xhr = new XMLHttpRequest();
		if (xhr.upload) {
			// File Drop
			$('.file-drag').on('dragover', function (e) {
				e.stopPropagation();
				e.preventDefault();
				$(this).addClass('hover');
			});
			$('.file-drag').on('dragleave', function (e) {
				e.stopPropagation();
				e.preventDefault();
				$(this).removeClass('hover');
			});
			$('.file-drag').on('drop', function (e) {
				var files = e.target.files || e.originalEvent.dataTransfer.files;
				var file = files[0];
				e.stopPropagation();
				e.preventDefault();

				// var fileType = file.type;
				// console.log(fileType);
				var imageName = file.name;

				var isGood = (/\.(?=gif|jpg|png|jpeg)/gi).test(imageName);
				if (isGood) {
					$(this).find('.start').addClass('d-none');
					// $(this).find('.messages').removeClass('d-none').text(encodeURI(file.name));
					$(this).find('.file-image-preview').removeClass("d-none").attr('src', URL.createObjectURL(file));
				} else {
					$(this).find('.file-image-preview').addClass("d-none").attr('src', '#');
					$(this).find('.start').removeClass('d-none');
					// $(this).find('.messages').addClass('d-none');
					Toast.fire({
						icon: 'error',
						title: 'Vui lòng chọn file hợp lệ'
					})
					// document.getElementById("file-upload-form").reset();
				}
			});

		}
		//#endregion
	}
	ekUpload();
	// /Single image preview






	//check max file size 
	$('.file-upload').bind('change', function () {
		if (this.files[0].size >= 2097152) {
			Toast.fire({
				icon: 'error',
				title: 'Kích thước file tải lên quá lớn! <br> Hãy chọn file nhỏ hơn <b>2mb</b>!'
			});
			$(this).val(null);
			$('.file-image-preview').addClass("d-none")
			.next().removeClass('d-none')
			.next().addClass('d-none');
		}
	})




	function change_csrf(key, val) {
		$('.csrf').attr('name', key).val(val);
		csrf_key	= key;
		csrf_val	= val;
	}


});
