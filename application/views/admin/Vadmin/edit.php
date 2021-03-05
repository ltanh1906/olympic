<div class="titleArea">
	<div class="wrapper">
		<div class="pageTitle">
			<h5>Quản trị admin</h5>
			<span>Quản lý admin</span>
		</div>
		
		<div class="horControlB menu_action">
			<ul>
				<li><a href="{admin_url('Caccount/add')}">
					<img src="{public_url('admin')}/images/icons/control/16/add.png">
					<span>Thêm mới</span>
				</a></li>
				
				<li><a href="{admin_url('Caccount/index')}">
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
    <div class="widget">
        <div class="title">
			<h6>Chỉnh sửa thông tin</h6>
        </div>

        <form class="form" id="form" action="" method="post" enctype="multipart/form-data">
            <fieldset>

                <div class="formRow">
                    <label for="param_khoa" class="formLeft">Khoa:<span class="req">*</span></label>
                    <div class="formRight">
                        <select name="khoa" id="param_khoa"  class="left" >
                                <option value=""></option>
                                <!-- kiem tra danh muc co danh muc con hay khong -->
                                {foreach $khoa as $row}
                                <option value="{$row.sMaKhoa}"{if $row.sMaKhoa == $info.sMaKhoa}selected{/if}>{$row.sTenKhoa}</option>
                                {/foreach}
                        </select>
                        <span class="autocheck" name="cat_autocheck"></span>
                        <div class="clear error" name="cat_error">{form_error('khoa')}</div>
                    </div>
                    <div class="clear"></div>
                </div>
                <div class="formRow">
                <label for="param_cat" class="formLeft">Quyền hạn:<span class="req">*</span></label>
                <div class="formRight">
                    <select name="quyen"  class="left" >
                            <option value=""></option>
                            <!-- kiem tra danh muc co danh muc con hay khong -->
                            {foreach $quyen as $row}
                            <option value="{$row.sIDQuyen}"{if $row.sIDQuyen == $info.sIDQuyen}selected{/if}>{$row.sTenQuyen}</option>
                            {/foreach}
                    </select>
                    <span class="autocheck" name="cat_autocheck"></span>
                    <div class="clear error" name="cat_error">{form_error('quyen')}</div>
                </div>
                <div class="clear"></div>
            </div>
                <div class="formRow">
                    <label class="formLeft" for="param_username">Username:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input  name="username" value="{$info.sTenTaiKhoan}" id="param_username" _autocheck="true" type="text" disabled style="background: #d2d2d2;" /></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error">{form_error('username')}</div>
                    </div>
                        <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="param_password">Mật khẩu mới:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="password" id="param_password" _autocheck="true" type="password" /></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error">{form_error('password')}</div>
                    </div>
                        <div class="clear"></div>
                </div>

                <div class="formRow">
                    <label class="formLeft" for="param_re_password">Nhập lại mật khẩu mới:<span class="req">*</span></label>
                    <div class="formRight">
                        <span class="oneTwo"><input name="re_password" id="param_re_password" _autocheck="true" type="password" /></span>
                        <span name="name_autocheck" class="autocheck"></span>
                        <div name="name_error" class="clear error">{form_error('password')}</div>
                    </div>
                        <div class="clear"></div>
                </div>

                <div class="formSubmit">
	           			<input type="submit" value="Cập nhật" class="redB" />
	           		</div>

            </fieldset>
        </form>
    </div>
</div>