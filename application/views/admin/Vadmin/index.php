
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

	{if isset($message) && $message}
	<div class="nNote nInformation hideit">
			<p><strong>Thông báo: </strong>{$message}</p>
	</div>
	{/if}
	
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" id="titleCheck" name="titleCheck"></span>
			<h6>Danh sách Admin</h6>
		 	<div class="num f12">Tổng số: <b>{$total}</b></div>
        </div>
        <table cellpadding="0" cellspacing="0" width="100%" class="sTable mTable myTable withCheck" id="checkAll">
			<thead>
				<tr>
					<td style="width:10px;"><img src="{public_url('admin')}/images/icons/tableArrows.png" /></td>
					<td style="width:80px;">Mã số</td>
					<td>Ussername</td>
					<td>Khoa</td>
					<td style="width:100px;">Hành động</td>
				</tr>
			</thead>
			
 			<tfoot>
				<tr>
					<td colspan="7">
					     <div class="list_action itemActions">
								<!-- <a href="#submit" id="submit" class="button blueB" url="user/del_all.html">
									<span style='color:white;'>Xóa hết</span>
								</a> -->
								<a href="{admin_url('Export/Excel')}" id="exportWord" class="button blueB">
									<span style='color:white;'>Export Word</span>
								</a>
						 </div>
							
					     <div class='pagination'>
			               			            </div>
					</td>
				</tr>
			</tfoot>
 			
			<tbody>
            <!-- lặp hiển thị-->
				{foreach $list as $row}
                
                <tr>
						<td><input type="checkbox" name="id[]" value="{$row.sIDTaiKhoan}" /></td>
						
						<td class="textC">{$row.sIDTaiKhoan}</td>
						
						
						<td>
                            <span title="{$row.sTenTaiKhoan}" class="tipS">{$row.sTenTaiKhoan}</span>
                        </td>
						
						
						<td>
                            <span title="{$row.sMaKhoa}" class="tipS">{$row.sTenKhoa}</span>
                        </td>
						
						<td class="option">
							 <a href="{admin_url('Caccount/edit/')}{$row.sIDTaiKhoan}" title="Chỉnh sửa" class="tipS ">
							<img src="{public_url('admin')}/images/icons/color/edit.png" />
							</a>
							
							<a href="{admin_url('Caccount/delete/')}{$row.sIDTaiKhoan}" title="Xóa" class="tipS verify_action" >
							    <img src="{public_url('admin')}/images/icons/color/delete.png" />
							</a>
						</td>
                </tr>
                {/foreach}
            </tbody>
        </table>
	</div>
</div>
<div class="clear mt30"></div>
