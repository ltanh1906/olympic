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
<script type="text/javascript">
(function($)
{
	$(document).ready(function()
	{
		var main = $('#form');
		// Tabs
		main.contentTabs();
	});
})(jQuery);
</script>

<div class="line"></div>

{if isset($message) && $message}
	<div class="nNote nInformation hideit">
			<p><strong>Thông báo: </strong>{$message}</p>
	</div>
	{/if}

<div id="main_product" class="wrapper">
	<div class="widget">
		<div class="title">
			<span class="titleIcon"><input type="checkbox" name="titleCheck" id="titleCheck"></span>
			<h6>
				Danh sách bài viết		
			</h6>
		 	<div class="num f12">Số lượng: <b>{$total_rows}</b></div>
		</div>
		
		<table width="100%" cellspacing="0" cellpadding="0" id="checkAll" class="sTable mTable myTable">
			
			<thead class="filter"><tr><td colspan="7">
				<form method="get" action="{admin_url('Cbaiviet')}" class="list_filter form">
					<table width="80%" cellspacing="0" cellpadding="0"><tbody>
					
						<tr>
							<!-- <td style="width:40px;" class="label"><label for="filter_id">Mã số</label></td> -->
							
							
							<td style="width:40px;" class="label"><label for="filter_id">Tên</label></td>
							<td style="width:155px;" class="item"><input type="text" style="width:155px;" id="filter_iname" value="{set_value('tieude')}" name="tieude"></td>
							
							<td style="width:60px;" class="label"><label for="filter_status">Thể loại</label></td>
							<td class="item">
								<select name="loaitin">
									<option value=""></option>
										<!-- kiem tra danh muc co danh muc con hay khong -->
										{foreach $loaitin as $row}	
											<option value="{$row.sIDLoaiTin}">{$row.sTenLoaiTin}</option>
										{/foreach}
								</select>
							</td>
							
							<td style="width:150px">
							<input type="submit" value="Lọc" class="button blueB">
							<input type="reset" onclick="window.location.href = '{admin_url('Cbaiviet')}'; " value="Reset" class="basic">
							</td>
							
						</tr>
					</tbody></table>
				</form>
			</td></tr></thead>
			
			<thead>
				<tr>
					<td style="width:21px;"></td>
					
					<td>Tiêu đề</td>
					<td style="width: 110px;">Danh mục</td>
					<td>Tóm tắt</td>
					<td style="width:75px;">Ngày tạo</td>
					<td style="width:120px;">Hành động</td>
				</tr>
			</thead>
			
 			<tfoot class="auto_check_pages">
				<tr>
					<td colspan="7">
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
			     <tr class="row_9">
					<td><input type="checkbox" value="{$row.sIDBaiviet}" name="id[]"></td>
					
					
					
					<td style="    max-width: 75px;">
					
					
					<a target="_blank" title="" class="tipS" href="">
					    <b>{$row.sTieuDe}</b>
					</a>
					
						
					</td>
					
					<td class="textR">
					       <p style="text-align: center">{$row.sTenLoaiTin}</p>
					</td>
					<td class="textC" style="max-width: 50px; text-align:justify !important;"><div class="tomtat">{$row.tTomTat}</div></td>
					<td class="textC">{date("d-m-Y", $row.dNgayDang)}</td>
					
					<td class="option textC">
						<a class="tipS" title="Chỉnh sửa" href="{admin_url('Cbaiviet/edit/')}{$row.sIDBaiviet}">
							<img src="{public_url('admin/images')}/icons/color/edit.png">
						</a>
						
						<a class="tipS verify_action" title="Xóa" href="{admin_url('Cbaiviet/delete/')}{$row.sIDBaiviet}">
						    <img src="{public_url('admin/images')}/icons/color/delete.png">
						</a>
					</td>
				</tr>
				{/foreach}
		   </tbody>
			
		</table>
	</div>
	
</div>


