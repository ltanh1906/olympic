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
<style>
.thumbnail{
	font-size: 50px !important;
}
</style>
<div class="line"></div>

<div id="main_product" class="wrapper">
	<div class="widget">
	
		<div class="title">
			<span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
			<h6>
				Danh sách ảnh			
			</h6>
		 	<div class="num f12">Số lượng: <b>{$total_rows}</b></div>
		</div>
		
		
		<table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable mTable myTable">
			
			<thead class="filter"><tr><td colspan="6">
				<form method="get" action="{admin_url('Cimg')}" class="list_filter form">
					<table width="80%" cellspacing="0" cellpadding="0"><tbody>
						<tr>			
							<td style="width:60px;" class="label"><label for="filter_status">Mục</label></td>
							<td class="item">
								<select name="type">
									<option value=""></option>
									<option value="slide">Slide</option>
									<option value="album">Album</option>
									<option value="video">Video</option>
								</select>
							</td>
							
							<td style="width:150px">
							<input type="submit" value="Lọc" class="button blueB">
							<input type="reset" onclick="window.location.href = '{admin_url('Cimg')}'; " value="Reset" class="basic">
							</td>
							
						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td style="width:21px;"><img src="{public_url('admin/images')}/icons/tableArrows.png"></td>
					<!-- <td style="width:60px;">Mã số</td> -->
					<td>Preview</td>
					<td>Mô tả</td>
					<td>Mục</td>
					<td style="width:75px;">Ngày tạo</td>
					<td style="width:120px;">Hành động</td>
				</tr>
			</thead>
			
 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="6">
						 <div class="list_action itemActions">
								
						 </div>
							
					     <div class="pagination">
					          {$pagi}
			             </div>
					</td>
				</tr>
			</tfoot>
			
			<tbody class="list_item">
				{foreach $list as $row}
			     <tr class="row_{$row.sIDAnh}">
					<td><input type="checkbox" value="{$row.sIDAnh}" name="id[]"></td>
					
					<td style="text-align: center;">
						{if $row.Type != 'video'}
						<div class="image_thumb">
							<img style="width: 100%; height:100%;" src="{base_url('upload/slide/')}{$row.sLink}">
							<div class="clear"></div>
						</div>
						{else}
							<a class="thumbnail" href="{$row.sLink}"><i class="far fa-file-video" ></i></a>
						{/if}
					</td>
					
					<td class="textR" style="width: 50%; text-align: left !important;">
						<a target="_blank" title="" class="tipS" href="">
							<b>{$row.sMoTa}</b>
						</a>
					</td>
					<td class="textC">{$row.Type}</td>
					<td class="textC">{date('d-m-Y', $row.dNgayTao)}</td>
					
					<td class="option textC">
						 <a class="tipS" value="{$row.sIDAnh}" title="Chỉnh sửa" href="{admin_url('Cimg/edit/')}{$row.sIDAnh}">
							<img src="{public_url('admin/images')}/icons/color/edit.png">
						</a>
						
						<a class="tipS verify_action" value="{$row.sIDAnh}" title="Xóa" href="{admin_url('Cimg/delete/')}{$row.sIDAnh}">
						    <img src="{public_url('admin/images')}/icons/color/delete.png">
						</a>
					</td>
				</tr>
				{/foreach}
		   </tbody>
			
		</table>
	</div>
	
</div>


