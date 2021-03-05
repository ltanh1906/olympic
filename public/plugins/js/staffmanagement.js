$(document).ready(() => {
	$(function () {
		$('[data-toggle="tooltip"]').tooltip()
	})
	$('#dt-table').DataTable();
	var url			= window.location.href;
	var csrf_key	= $('.csrf').attr('name');
	var csrf_val	= $('.csrf').val();
	// $('.money').simpleMoneyFormat();

	//fix lỗi click vào 
	// $('#personal-dropdown').next().toggle().prev().click().blur().next().toggle();

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
			text: 'Bạn sẽ không thể hoàn tác!',
			icon: 'warning',
			showCancelButton: true,
			confirmButtonColor: '#3085d6',
			cancelButtonColor: '#d33',
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

	$('.btn.reset-modal').on('click', function () {
		$('#staff-name').val('');
		$('#account-username').val('');
		$('#account-password').val('');
		$('#account-quyen').val($('#account-quyen option:first').val());
	});

	$('.btn.add-staff').on('click', function () {
		var staff = {
			'sTenNV': $('#staff-name').val()
		};
		var account = {
			'sUsername'	: $('#account-username').val(),
			'sPassword'	: $('#account-password').val(),
			'FK_iMaQ'	: $('#account-quyen').val()
		};
		$.post('',
		{
			action		: 'add-staff',
			[csrf_key]	: csrf_val,
			staff		: staff,
			account		: account
		},
		function(res){
			change_csrf(res.csrf_key, res.csrf_val);
			if (res.data) {
				Toast.fire({
					icon: 'success',
					title: `Chào mừng&nbsp;${staff.sTenNV}&nbsp;đến với hệ thống!`
				});
				$('.btn.reset-modal').click();
				$('.modal').modal('toggle');
				var html = `
				<div class="card p-3 mx-2" data-toggle="tooltip" data-html="true" title="Người thêm: <b>Bạn</b>">
					<div class="d-flex align-items-center">
						<div class="image"> <img src="assets/img/staffs/default-staff-img.png" alt="${staff.sTenNV}" class="rounded img-square" width="155" height="155"> </div>
						<div class="ml-3 w-100">
							<h5 class="mb-0 mt-0 text-primary">${staff.sTenNV}</h5>
							<span> </span><br>
							<span> </span><br>
							<span> </span>
							<div class="button mt-2 d-flex flex-row align-items-center">
								<button class="btn btn-sm btn-outline-primary w-100">Thôi việc</button>
							</div>
						</div>
					</div>
				</div>`;
				if (account.FK_iMaQ == 2) {
					$('#list-manager').append(html);
				}
				else {
					$('#list-staff').append(html);
				}
			}
			else {
				Toast.fire({
					icon: 'error',
					title: `Tên đăng nhập&nbsp;${account.sUsername}&nbsp;này đã tồn tại!`
				});
			}
		}, 'json');

	})









	function change_csrf(key, val) {
		$('.csrf').attr('name', key).val(val);
		csrf_key	= key;
		csrf_val	= val;
	}


});
