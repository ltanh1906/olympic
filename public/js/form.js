$(document).ready(() => {
	var url			= window.location.href

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

	$("button[name=action]").on('click', function() {
		let user = $("#hoten").val();

		if(user == ''){
			Toast.fire({
				icon: 'warning',
				title: `Vui lòng nhập đầy đủ thông tin`
			})
			$("#add-period_btn-reset").click();
			$("#add-period_btn-reset").addClass("d-none");
		}
		else{
			
		}
	})


})
