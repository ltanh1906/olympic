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


	// input checkbox chung
	$('input[type=checkbox]').on('change', function () {
		if ($(this).is(':checked')) {
			$(this).next().addClass('text-primary').text($(this).data('on'));
		} else {
			$(this).next().removeClass('text-primary').text($(this).data('off'));
		}
	})
	// Tình trạng sản phẩm
	$('input#product-status').on('change', function () {
		if ($(this).is(':checked')) {
			$('#iSoLuong-block').removeClass('invisible');
			$('#product-remain').focus();
		} else {
			$('#iSoLuong-block').addClass('invisible');
		}
	});
	// /Tình trạng sản phẩm

	// Công khai giá sản phẩm
	$('input#product-public-price').on('change', function () {
		if ($(this).is(':checked')) {
			$('#price-row').addClass('d-none');
		} else {
			$('#price-row').removeClass('d-none');
		}
	});
	// /Công khai giá sản phẩm


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
					$(this).next().find('.messages').removeClass('d-none').text(imageName);
					$(this).next().find('.file-image-preview').removeClass("d-none").attr('src', URL.createObjectURL(file));
				} else {
					$(this).next().find('.file-image-preview').addClass("d-none").attr('src', '#');
					$(this).next().find('.start').removeClass('d-none');
					$(this).next().find('.messages').addClass('d-none');
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
				$(this).next().find('.messages').addClass('d-none');
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
					$(this).find('.messages').removeClass('d-none').text(encodeURI(file.name));
					$(this).find('.file-image-preview').removeClass("d-none").attr('src', URL.createObjectURL(file));
				} else {
					$(this).find('.file-image-preview').addClass("d-none").attr('src', '#');
					$(this).find('.start').removeClass('d-none');
					$(this).find('.messages').addClass('d-none');
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

	//#region Multiple image preview
	$(function () {
		// Multiple images preview in browser
		var imagesPreview = function (input) {
			$('div.gallery').html('').removeClass('d-none');

			if (input.files) {
				var filesAmount = input.files.length;

				for (i = 0; i < filesAmount; i++) {
					var reader = new FileReader();

					reader.onload = function (event) {
						$($.parseHTML('<img>')).attr('src', event.target.result).attr('width', '100px').addClass('mr-3').appendTo('div.gallery');
					}

					reader.readAsDataURL(input.files[i]);
				}
			}

		};

		$('#gallery-photo-add').on('change', function () {
			imagesPreview(this);
		});
	});
	//#endregion
	
	$('button[name=btn-delete]').on('click', function (e) {
		e.stopPropagation();
		e.preventDefault();
		Swal.fire({
			title: 'Xoá?',
			text: "Bạn sẽ không thể hoàn tác!",
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#d33',
			cancelButtonColor: '#3085d6',
			confirmButtonText: 'Xác nhận xoá!'
		}).then((result) => {
			if (result.isConfirmed) {
				var ma = $('input[name=ma]').val();
				var ten = $('input[name=name]').val();
				$.post('',
				{
					action:	'delete',
					[csrf_key] : csrf_val,
					ma:		ma,
					tbl:	tbl
				},
				function(res){
					change_csrf(res.csrf_key, res.csrf_val);
					if (res.data) {
						Swal.fire(
							'Đã xoá!',
							'Đã xoá <b>' + ten +'</b>.',
							'success'
						)
						$('.modal').modal('toggle');
						$('#'+ ma).remove();
					}
					else {
						Swal.fire(
							'Xoá thất bại!',
							'Có lỗi xảy ra trong quá trình xoá.',
							'error'
						)
					}
				}, 'json');



				
			}
		})
	});




	//#region Thêm loại
	$('button[name=btn-add-product-type]').on('click', function () {
		var product_type_name = $('input[name=sTenLD]').val();
		if (product_type_name) {
			$(this).parent().prev().removeClass('is-invalid');
			$input = $(this).parent().prev();
			var count_pt = $('li[name=product-type-list] span.d-flex').length;
			$.post('',
			{
				action: 'add-product-type',
				[csrf_key] : csrf_val,
				sTenLD: product_type_name
			},
			function(res){
				change_csrf(res.csrf_key, res.csrf_val);
				if (res.data) {
					Toast.fire({
						icon: 'success',
						title: 'Thêm loại sản phẩm thành công'
					});
					var span = 
					'<span id="' + res.data + '" class="d-flex">'
						+ '<div class="custom-control custom-radio mb-1">'
							+ '<input type="radio" id="pt' + count_pt + '" name="product-type" class="custom-control-input">'
							+ '<label class="custom-control-label" for="pt' + count_pt + '">' + product_type_name + '</label>'
						+ '</div>'
						+ '<span class="ml-auto call-modal" data-ma="' + res.data + '" data-ten="' + product_type_name + '" data-anh="" data-table="tbl_loai_do" data-toggle="modal" data-target="#modal-update">Sửa</span>'
					+ '</span>';
					$('li[name=product-type-list]').append(span);
					$input.val('');
					
				}
				else {
					Toast.fire({
						icon: 'error',
						title: 'Thêm loại sản phẩm thất bại'
					});
				}
				
			}, 'json');
		}
		else {
			$(this).parent().prev().addClass('is-invalid').focus()
			.next().next().text('Tên không được để trống');
		}
		
	})

	$('button[name=btn-add-wood-type]').on('click', function () {
		var wood_type_name = $('input[name=sTenLG]').val();
		if (wood_type_name) {
			$(this).parent().prev().removeClass('is-invalid');
			$input = $(this).parent().prev();
			var count_wt = $('li[name=wood-type-list] span.d-flex').length;
			$.post('',
			{
				action: 'add-wood-type',
				[csrf_key] : csrf_val,
				sTenLG: wood_type_name
			},
			function(res){
				change_csrf(res.csrf_key, res.csrf_val);
				if (res.data) {
					Toast.fire({
						icon: 'success',
						title: 'Thêm loại gỗ thành công'
					});
					var span = 
					'<span id="' + res.data + '" class="d-flex">'
						+ '<div class="custom-control custom-radio mb-1">'
							+ '<input type="radio" id="wt' + count_wt + '" name="wood-type" class="custom-control-input">'
							+ '<label class="custom-control-label" for="wt' + count_wt + '">' + wood_type_name + '</label>'
						+ '</div>'
						+ '<span class="ml-auto call-modal" data-ma="' + res.data + '" data-ten="' + wood_type_name + '" data-anh="" data-table="tbl_loai_go" data-toggle="modal" data-target="#modal-update">Sửa</span>'
					+ '</span>';
					$('li[name=wood-type-list]').append(span);
					$input.val('');
				}
				else {
					Toast.fire({
						icon: 'error',
						title: 'Thêm loại gỗ thất bại'
					});
				}
				
			}, 'json');
		}
		else {
			$(this).parent().prev().addClass('is-invalid').focus()
			.next().next().text('Tên không được để trống');
		}
	})

	$('button[name=btn-add-room-type]').on('click', function () {
		var room_type_name = $('input[name=sTenLP]').val();
		if (room_type_name) {
			$(this).parent().prev().removeClass('is-invalid');
			$input = $(this).parent().prev();
			var count_rt = $('li[name=room-type-list] span.d-flex').length;
			$.post('',
			{
				action: 'add-room-type',
				[csrf_key] : csrf_val,
				sTenLP: room_type_name
			},
			function(res){
				change_csrf(res.csrf_key, res.csrf_val);
				if (res.data) {
					Toast.fire({
						icon: 'success',
						title: 'Thêm loại phòng thành công'
					});
					var span = 
					'<span id="' + res.data + '" class="d-flex">'
						+ '<div class="custom-control custom-checkbox mb-1">'
							+ '<input type="checkbox" id="rt' + count_rt + '" name="room-type" class="custom-control-input">'
							+ '<label class="custom-control-label" for="rt' + count_rt + '">' + room_type_name + '</label>'
						+ '</div>'
						+ '<span class="ml-auto call-modal" data-ma="' + res.data + '" data-ten="' + room_type_name + '" data-anh="" data-table="tbl_loai_phong" data-toggle="modal" data-target="#modal-update">Sửa</span>'
					+ '</span>';
					$('li[name=room-type-list]').append(span);
					$input.val('');
				}
				else {
					Toast.fire({
						icon: 'error',
						title: 'Thêm loại phòng thất bại'
					});
				}
				
			}, 'json');
		}
		else {
			$(this).parent().prev().addClass('is-invalid').focus()
			.next().next().text('Tên không được để trống');
		}
		
	})

	$('.option-type').on('focusout', function () {
		$(this).removeClass('is-invalid');
	});
	//#endregion


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



	var tbl = '';
	//#region Sửa loại sản phẩm
	$(document).on('click', 'span.call-modal', function () {
		var data = $(this).data();
		$('input[name=ma]').val(data.ma);
		$('input[name=name]').val(data.ten);
		$('input[name=tbl]').val(data.table);
		tbl = data.table;
		if (data.anh) {
			$('img[name=anh-preview]').attr('src' , './assets/img/type/'+ data.anh).removeClass("d-none")
			.next().addClass('d-none')
			.next().removeClass('d-none').text(data.anh);
		}
		else {
			$('img[name=anh-preview]').addClass("d-none")
			.next().removeClass('d-none')
			.next().addClass('d-none');
		}
		
	})
	//#endregion




	function change_csrf(key, val) {
		$('.csrf').attr('name', key).val(val);
		csrf_key	= key;
		csrf_val	= val;
	}


});
