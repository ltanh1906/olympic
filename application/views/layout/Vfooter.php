
    <div class="foot_content">
		
        <p>TRƯỜNG ĐẠI HỌC MỞ HÀ NỘI</p>
        <p>B101 Nguyễn Hiền, Bách Khoa, Hai Bà Trưng, Hà Nội</p>
        <p>Website được xây dựng và phát triển bởi: Tổ phát triển - Khoa công nghệ thông tin © 2017-2018</p>
    </div>
    <script>
    	feather.replace();
    </script>
	<script>
    	$(document).ready(function () {
    		$(document).click(
    			function (event) {
    				var target = $(event.target);
    				var _mobileMenuOpen = $(".navbar-collapse").hasClass("show");
    				if (_mobileMenuOpen === true && !target.hasClass("navbar-toggler")) {
    					$("button.navbar-toggler").click();
    				}
    			}
    		);
			$('.inn-user-menu__nav').hover(() => {
				$('.inn-user-menu__nav__avatar-btn__link').addClass('text-white');
			});
			$('.inn-user-menu__nav').on('mouseleave', () => {
				$('.inn-user-menu__nav__avatar-btn__link').removeClass('text-white');
			});
    	});

		$(".custom-file-input").on("change", function() {
			var fileName = $(this).val().split("\\").pop();
			$(this).siblings(".custom-file-label").addClass("selected").html(fileName);
		});
    </script>

{if !empty($messages)}
    <script type="text/javascript">
    	$(document).ready(function () {
    		const Toast = Swal.mixin({
    			toast: true,
    			position: 'top-end',
    			showConfirmButton: false,
    			timer: 3000,
                customClass: 'swal2-toast',
    			timerProgressBar: true,
    			didOpen: (toast) => {
    				toast.addEventListener('mouseenter', Swal.stopTimer)
    				toast.addEventListener('mouseleave', Swal.resumeTimer)
    			}
    		})

    		Toast.fire({
    			icon: '{$messages.icon}',
    			title: '{$messages.title}',
    		})
    	});

    </script>
{/if}
</body>
</html>