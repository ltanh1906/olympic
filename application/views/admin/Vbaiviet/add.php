<!-- head -->
<div class="titleArea">
	<div class="wrapper">
		<div class="pageTitle">
			<h5>Bài viết</h5>
			<span>Quản lý bài viết</span>
		</div>
		
		<div class="horControlB menu_action">
			<ul>
			<li><a href="{admin_url('Cbaiviet/add')}">
					<img src="{public_url('admin')}/images/icons/control/16/add.png">
					<span>Thêm mới</span>
				</a></li>
				
				<li><a href="{admin_url('Cbaiviet/index')}">
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
		<form class="form" id="form" action="{admin_url('Cbaiviet/add')}" method="post" enctype="multipart/form-data">
			<fieldset>
				<div class="widget">
				    <div class="title">
						<img src="{public_url('admin')}/images/icons/dark/add.png" class="titleIcon">
						<h6>Thêm mới bài viết</h6>
					</div>
					
				    <ul class="tabs">
		                <li><a href="#tab1">Thông tin chung</a></li>           
					</ul>
					
					<div class="tab_container">
					     <div id="tab1" class="tab_content pd0">
						 <div class="formRow">
	<label for="param_cat" class="formLeft">Danh Mục:<span class="req">*</span></label>
	<div class="formRight">
	    <select name="loaitin"  class="left">
			<option value=""></option>
			{foreach $loaitin as $row}
				<option value="{$row['sIDLoaiTin']}">{$row['sTenLoaiTin']}</option>
			{/foreach}
		</select>
		<span class="autocheck" name="cat_autocheck"></span>
		<div class="clear error" name="cat_error">{form_error('loaitin')}</div>
	</div>
	<div class="clear"></div>
</div>
					         <div class="formRow">
	<label class="formLeft" for="param_tieude">Tiêu đề:<span class="req">*</span></label>
	<div class="formRight">
		<span class="oneTwo"><input name="tieude" id="tieude" _autocheck="true" type="text"></span>
		
		<div name="name_error" class="clear error">{form_error('tieude')}</div>
	</div>
	<div class="clear"></div>
	
</div>







<div class="formRow">
	<label class="formLeft" for="param_gifts">Tóm tắt:</label>
	<div class="formRight">
		<span class="oneTwo"><textarea name="tomtat" id="param_tomtat" rows="4" cols="" ></textarea></span>
		<span name="gifts_autocheck" class="autocheck"></span>
		<div name="gifts_error" class="clear error"></div>
	</div>
	<div class="clear"></div>
</div>					         <div class="formRow hide"></div>
<div class="formRow">
								<label class="formLeft">Nội dung:</label>
								<div class="formRight">
									<textarea name="content" id="param_content" class="editor1"></textarea>
									<!-- <script type='text/javascript'>
										CKEDITOR.replace('content');
									</script> -->
									
									<script type="text/javascript">               
										var editor = CKEDITOR.replace('content',{
										filebrowserBrowseUrl : '{public_url('plugins')}/ckfinder/ckfinder.html',
										filebrowserImageBrowseUrl : '{public_url('plugins')}/ckfinder/ckfinder.html?Type=Images',
										filebrowserFlashBrowseUrl : '{public_url('plugins')}/ckfinder/ckfinder.html?Type=Flash',
										filebrowserUploadUrl : '{public_url('plugins')}/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Filess',
										filebrowserImageUploadUrl : '{public_url('plugins')}/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Images',
										filebrowserFlashUploadUrl : '{public_url('plugins')}/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Flash',
										filebrowserWindowWidth : '800',
										filebrowserWindowHeight : '480'
										});
									</script>
								<div name="content_error" class="clear error"></div>			
	</div>
	<div class="clear"></div>
</div>
						      <div class="formRow hide"></div>
						 </div>
						 </div>
						 
						 
						     			

						 
						 <div id="tab3" class="tab_content pd0">
						      
						
						
	        		</div><!-- End tab_container-->
	        		
	        		<div class="formSubmit">
	           			<input type="submit" value="Thêm mới" class="redB">
	           			<input type="reset" value="Hủy bỏ" class="basic">
	           		</div>
	        		<div class="clear"></div>
				</div>
			</fieldset>
		</form>
</div>
<div class="clear mt30"></div>