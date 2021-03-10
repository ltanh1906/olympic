<!-- head -->
<div class="titleArea">
	<div class="wrapper">
		<div class="pageTitle">
			<h5>Timeline</h5>
			<span>Quản lí lịch trình cuộc thi</span>
		</div>
		
		<div class="horControlB menu_action">
			<ul>
				<li><a href="{admin_url('Ctimeline/index')}">
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
						<h6>Sửa thời gian vòng thi</h6>
					</div>
			
					<div class="tab_container">
					     <div id="tab1" class="tab_content pd0">
						 
					         <div class="formRow">
                                <label class="formLeft" for="param_tieude">Tiêu đề:<span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input name="tieude" id="param_tieude" _autocheck="true" type="text" value="{$vongthi->sTenVongThi}" disabled></span>
                                    <span name="name_autocheck" class="autocheck"></span>
                                    <div name="name_error" class="clear error">{form_error('tieude')}</div>
                                </div>
                                <div class="clear"></div>
                                
                            </div>
                            <div class="formRow">
                                <label class="formLeft" for="param_tieude">Ngày thi:<span class="req">*</span></label>
                                <div class="formRight">
                                    <span class="oneTwo"><input name="date" id="param_date" _autocheck="true" 
                                    type="date" value= "{date('Y-m-d', $vongthi->sThoiGian)}"></span>
                                    <span name="name_autocheck" class="autocheck"></span>
                                    <div name="name_error" class="clear error">{form_error('date')}</div>
                                </div>
                                <div class="clear"></div>
                                
                            </div>

			         
	<div class="clear"></div>
</div>
						      <div class="formRow hide"></div>
						 </div>
						 </div>
						 
	        		<div class="formSubmit">
	           			<input type="submit" value="Cập nhật" class="redB">
	           		</div>
	        		<div class="clear"></div>
				</div>
			</fieldset>
		</form>
</div>
<div class="clear mt30"></div>