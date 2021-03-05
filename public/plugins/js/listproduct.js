$(document).ready(() => {
	$('#dt-table').DataTable();
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

	$('button[name=btn-delete]').on('click', function (e) {
		e.stopPropagation();
		e.preventDefault();
		var ten	= $(this).data('ten');
		var ma	= $(this).data('ma');
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
				$.post('',
				{
					action:	'deleteProduct',
					[csrf_key] : csrf_val,
					ma:		ma
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










	function change_csrf(key, val) {
		$('.csrf').attr('name', key).val(val);
		csrf_key	= key;
		csrf_val	= val;
	}


});
