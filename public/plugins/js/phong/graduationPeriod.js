$(document).ready(() => {
	var url			= window.location.href
	var csrf_key	= $('.csrf').attr('name')
	var csrf_val	= $('.csrf').val()

	var addPeriodLabel = ['Tạo đợt tốt nghiệp', 'Cập nhật đợt tốt nghiệp']

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

	//#region Sửa loại sản phẩm
	$(document).on('click', '.btn[name=btn-edit]', function () {
		var data = $(this).data()
		$('input[name=PK_sMaDTN]').val(data.pk)
		$('input[name=dNgayBD]').val(data.ngaybd).focus()
		$('input[name=dNgayKT]').val(data.ngaykt)
		$('#add-period_label').text(addPeriodLabel[1])
		$('#add-period_btn-reset').removeClass('d-none')
	})

	$('#add-period_btn-reset').on('click', function() {
		$('#add-period_label').text(addPeriodLabel[0])
		$(this).addClass('d-none')
	})


	//#endregion




	function change_csrf(key, val) {
		$('.csrf').attr('name', key).val(val)
		csrf_key	= key
		csrf_val	= val
	}


})
