<div class="titleArea">
	<div class="wrapper">
		<div class="pageTitle">
			<h5>Danh mục lịch trình cuộc thi</h5>
			<span>Quản lý thời gian cuộc thi</span>
		</div>
		
		<div class="horControlB menu_action">
			<ul>
				<li><a href="{admin_url('Ctimeline/add')}">
					<img src="{public_url('admin')}/images/icons/control/16/add.png">
					<span>Thêm mới</span>
				</a></li>
				
				<li><a href="{admin_url('Ctimeline/index')}">
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
				Lịch trình cuộc thi		
			</h6>
		</div>
		
		
		<table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable mTable myTable">
			
			<thead class="filter"><tr><td colspan="6">
			</td></tr></thead>
			
			<thead>
				<tr>
					<td style="width:21px;"><img src="{public_url('admin/images')}/icons/tableArrows.png"></td>
					<!-- <td style="width:60px;">Mã số</td> -->
					<td>Nội dung thi</td>
					<td>Ngày thi</td>
					<td>Tác vụ</td>
				</tr>
			</thead>
			
			
			<tbody class="list_item">
				{foreach $time as $r}
			     <tr class="row_{$row.sIDAnh}">
					<td><input type="checkbox" value="{$row.sIDAnh}" name="id[]"></td>
			
					<td class="textR" style="width: 50%; text-align: left !important;">
						<a target="_blank" title="" class="tipS" href="">
							<b>{$r.sTenVongThi}</b>
						</a>
					</td>
					<td class="textC">{date('d-m-Y', $r.sThoiGian)}</td>
					
					<td class="option textC">
						 <a class="tipS" value="{$r.idVongThi}" title="Chỉnh sửa" href="{admin_url('Ctimeline/edit/')}{$r.idVongThi}">
							<img src="{public_url('admin/images')}/icons/color/edit.png">
						</a>
					</td>
				</tr>
				{/foreach}
		   </tbody>
			
		</table>
	</div>
	
</div>


