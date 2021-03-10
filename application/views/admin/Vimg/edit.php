<!-- head -->
<link rel="stylesheet" type="text/css" href="{public_url('site')}/bootstrap/css/bootstrap.min.css" />
    <script type="text/javascript" src="{public_url('site')}bootstrap/js/bootstrap.min.js"></script>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>
	<div class="titleArea">
	<div class="wrapper">
		<div class="pageTitle">
			<h5>Danh mục tài nguyên</h5>
			<span>Quản lý danh mục tài nguyên</span>
		</div>
		
		<div class="horControlB menu_action">
			<ul>
				<li><a href="{admin_url('Cimg/add')}">
					<img src="{public_url('admin')}/images/icons/control/16/add.png">
					<span>Thêm mới</span>
				</a></li>
				
				<li><a href="{admin_url('Cimg/index')}">
					<img src="{public_url('admin')}/images/icons/control/16/list.png">
					<span>Danh sách</span>
				</a></li>
			</ul>
		</div>
		
		<div class="clear"></div>
	</div>
</div>
<div class="line"></div>
<div class="wrapper">
	   	<!-- Form -->
		<form class="form" id="form" action="" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="widget">
				    <div class="title">
						<img src="{public_url('admin')}/images/icons/dark/add.png" class="titleIcon">
						<h6>Thêm mới tài nguyên</h6>
					</div>
					
					<div class="tab_container">
	
</div>
			<div class="formRow">
			<div class="form-group">
				<label for="name">Tiêu đề</label>
				<input type="text" class="form-control" name="tieude" value="{$tn->sMoTa}" >
				<div name="name_error" class="clear error">{form_error('tieude')}</div>
			</div>
			
			<div class="form-group">
				<label for="seeAnotherField">Thể loại: </label>
				<select class="form-control" id="seeAnotherField" name="type"  style="width: 98% !important;">
					<option value="slide"{if $tn->Type=='slide'}selected{/if} >Ảnh Slide</option>
					<option value="album"{if $tn->Type=='album'}selected{/if}>Ảnh Album</option>
					<option value="video"{if $tn->Type=='video'}selected{/if}>Video</option>
				</select>
			</div>
			
			<div class="form-group" id="otherFieldDiv">
				<label for="" class="formLeft">Thêm link video</label>
				<input type="text" name="linkvideo">
			</div>
			<div class="form-group" id="hinhanh">
				<label for="" class="formLeft">Ảnh mới:</label>
				<div class="select" style="text-align:right;">
														<label style="text-align:left !important;"><b></b></label>
														<input type="file" class="form-control" id="imgage" name="image">
														<a style="text-align: right;
				border-width: 0 2px 2px;
				font-weight: bold;
				border-color: #ad9a9a;
				margin-top: -2px;"  class="btn" width="100%" alt="" data-toggle="modal" data-target="#myModal">Xem trước</a>
													</div>
													<div class="modal fade" id="myModal" role="dialog">
														<div class="modal-dialog">
															<!-- Modal content-->
															<div class="modal-content">
																<div class="modal-header">
																	<button type="button" class="close" data-dismiss="modal">&times;</button>
																	<img frameborder="0" scrolling="no" class="hide-album" id="blah" src="#" class="fluid modal-title" style="overflow:hidden;height:100%;width:100%" height="100%" width="100%" alt="image">
																	<figcaption  class="figure-caption text-center"></figcaption>
																</div>
															</div>
														</div>
													</div>
													<div class="old-pic">
				<label for="">Ảnh hiện tại: </label>
				<img width="300" src="{base_url('upload/slide/')}{$tn->sLink}" alt="">
			</div>
			</div>
			
  
  
 

	        		<div class="formSubmit">
	           			<input type="submit" value="Update" class="redB">
	           			<input type="reset" value="Hủy bỏ" class="basic">
	           		</div>
	        		<div class="clear"></div>
				</div>
			</fieldset>
		</form>
</div>
<div class="clear mt30"></div>


<script>
        function readURL(input) {
  if (input.files && input.files[0]) {
    var reader = new FileReader();
    
    reader.onload = function(e) {
      $('#blah').attr('src', e.target.result);
    }
    
    reader.readAsDataURL(input.files[0]); // convert to base64 string
  }
}

$("#imgage").change(function() {
  readURL(this);
});
    </script>
	<script>
$("#seeAnotherField").change(function() {
  if ($(this).val() == "video") {
    $('#otherFieldDiv').show();
	$('#hinhanh').hide();
  
  } else {
    $('#otherFieldDiv').hide();
	$('#hinhanh').show();

  }
});
$("#seeAnotherField").trigger("change");

</script>