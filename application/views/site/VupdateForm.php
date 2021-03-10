{$user = getSession()}
<form class="form" id="form" action="" method="post" enctype='multipart/form-data'>
    <div class="main_center col-lg-12">
        <div class="b_center col-lg-12 row">
            <div class="c_content col-lg-6">
                <div class="tit-thongbao">
                    <div class="clearfix vi-header">
                        <div class="form-horizontal"> 
                            <div class="header">Thông tin cá nhân</div> 
                            <div class="form-content"> 
                                <div class="form-group">
                                    <div class="form-row">
                                    <div class="col-lg-12">
                                        <label><b>Họ và Tên:</b></label>
                                        <input type="text" value="{$t->sHoTenDem} {$t->sTen}" class="form-control" placeholder="Họ của bạn" id="param_hoten" name="hoten">
                                        <div name="name_error" class="clear error">{form_error('hoten')}</div>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="col-lg-12">
                                        <div class="row">
                                            <div class="col-lg-5">
                                                <label><b>Giới tính:</b></label>
                                                <div class="" data-toggle="buttons">       
                                                    <div class="gender">
                                                        <label id="btn" class="btn btn-outline-secondary {if $t->sGioiTinh=='Nam'} active {/if} for="nam">Nam
                                                            <input {if $t->sGioiTinh=='Nam'} Checked {/if} type="radio" name="gioi-tinh[]" value="Nam" id="nam">
                                                        </label>
                                                        <label id="btn" class="btn btn-outline-secondary {if $t->sGioiTinh=='Nữ'} active{/if} for="nu">Nữ
                                                            <input {if $t->sGioiTinh=='Nữ'}Checked{/if} type="radio" name="gioi-tinh[]" value="Nữ" id="nu">
                                                        </label>
                                                    </div>
                                                </div>
                                            </div>  
                                            <div class="col-lg-7">
                                                <label for=""><b>Ngày Sinh:</b></label>
                                                <div class="date">
                                                    <input id="dob" name="dob" value= "{date('Y-m-d', $t->dNgaySinh)}" type="date" class="form-control">
                                                    <div name="name_error" class="clear error">{form_error('dob')}</div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="select col-lg-12">
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                    <div class="col-lg-12">
                                        <label><b>Email:</b></label>
                                        <input type="text" value="{$t->sEmail}" placeholder="Email của bạn" class="form-control"  name="mail">
                                        <div name="name_error"  class="clear error">{form_error('mail')}</div>
                                    </div>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <div class="form-row">
                                    <div class="col-lg-12">
                                        <label><b>Số điện thoại:</b></label>
                                        <input type="text" value="{$t->sSDT}" placeholder="Số điện thoại của bạn" class="form-control"  name="sdt">
                                        <div name="name_error" class="clear error">{form_error('sdt')}</div>
                                    </div>
                                    </div>
                                </div>
                                {if $t->FK_sMaKhoa == 14}
                                <div class="form-group">
                                    <div class="form-row">
                                    <div class="col-lg-12">
                                        <label><b>Ảnh minh chứng:</b></label>
                                        <img width=100% src="{base_url('upload/minhchung/')}{$t->sMinhchung}" alt="">
                                    </div>
                                    </div>
                                </div>
                                {/if}
                            </div>
                        </div> 
                    </div>
                </div>
                
            </div>
            <div class="c_content col-lg-6">
                <div class="tit-thongbao">
                    <div class="clearfix vi-header">
                        <div class="form-horizontal"> 
                            <div class="header1">Thông tin dự thi</div> 
                            <div class="form-content"> 
                                <div class="form-group">
                                {if $t->FK_sMaKhoa != 14}
                                    <div class="form-group">
                                        <div class="select">
                                            <label><b>Khoa</b></label>
                                            <select {if $user->sIDQuyen != 0}disabled{/if}  class="form-control" id="khoa" name="khoa" >
                                            <option value="">--Khoa--</option>
                                            {foreach $listkhoa as $r}
                                            <option value="{$r.sMaKhoa}" 
                                            {if $r.sMaKhoa == $user->sMaKhoa}selected{/if}>
                                            {$r.sTenKhoa}</option>
                                            {/foreach}
                                            </select>
                                        </div>
                                        <div name="name_error" class="clear error">{form_error('khoa')}</div>
                                    </div>
                                {else}
                                <div class="form-group">
                                    <div class="form-row">
                                    <div class="">
                                        <label><b>Đơn vị đào tạo(Trường):</b></label>
                                        <input type="text" class="form-control" value="{$t->sTruong}" placeholder="vd: Đại Học Mở Hà Nội" name="truong">
                                        <div name="name_error" class="clear error">{form_error('truong')}</div>
                                    </div>
                                    </div>
                                </div>
                                    <div class="form-group">
                                        <div class="select">
                                            <label><b>Khoa</b></label>
                                            <input type="text" value="{$t->sKhoa}" class="form-control" placeholder="Khoa" name="khoa">
                                        </div>
                                        <div name="name_error" class="clear error">{form_error('khoa')}</div>
                                    </div>
                                    {/if}
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-lg-6">
                                                <label><b>Lớp hành chính: </b></label>
                                                <input type="text" class="form-control" value="{$t->sLop}"  placeholder="Lớp hành chính của bạn"  name="lop">
                                                <div name="name_error" class="clear error">{form_error('lop')}</div>
                                            </div>
                                            <div class="col-lg-6">
                                                <label><b>Mã Sinh Viên: </b></label>
                                                <input type="text" class="form-control" value="{$t->sMaSinhVien}" placeholder="Mã sinh viên của bạn"  name="masv">
                                                <div name="name_error" class="clear error">{form_error('masv')}</div>
                                            </div>
                                        </div>
                                    </div>
                                    {if $t->FK_sMaKhoa == 14}
                                    <div class="form-group">
                                        <div class="select" style="text-align:right;">
                                            <label style="text-align:left !important;"><b>Ảnh minh chứng (*Tải lên ảnh chụp thẻ sinh viên, CCCD hoặc CMND)</b></label>
                                            <input type="file" class="form-control" id="imgage" name="image">
                                            <a style="text-align: right;
    border-width: 0 2px 2px;
    font-weight: bold;
    border-color: #ad9a9a;
    margin-top: -2px;" onclick="PreviewImage();" class="btn" width="100%" alt="" data-toggle="modal" data-target="#myModal">Xem trước</a>
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
                                    </div>
                                    {/if}
                                    <div class="form-group">
                                        <div class="monthi">
                                            <label><b>Môn Thi</b></label>
                                            <select class="form-control" name="mon">
                                                <option value="" selected>---Môn thi---</option>
                                                {foreach $listmon as $k}
                                                    <option {if $k.sMaMon == $t->sMaMon}selected{/if} value="{$k.sMaMon}">{$k.sTenMon}</option>
                                                {/foreach}
                                            </select>
                                            <div name="name_error" class="clear error">{form_error('mon')}</div>
                                        </div>
                                    </div>
                                    {if $t->FK_sMaKhoa != 14}
                                    <input style="    opacity: 0;
    position: absolute;" name="truong" value="ĐH Mở Hà Nội">
                                    <div class="form-group gioitinh">
                                    <div class="">
                                        <label><b>Ghi chú:</b></label>
                                    </div>  
                                    
                                </div>
                               
                                <div class="form-group">
                                    <div class="" data-toggle="buttons">       
                                        <div class="gender">
                                            {if $t->sGhiChu == "Chính thức"}
                                                <label id="btn" class="btn btn-outline-secondary active" for="chinhthuc">Chính Thức
                                                    <input checked type="radio" name="hinhthuc[]" value="Chính thức" id="chinhthuc">
                                                </label>
                                                <label id="btn" class="btn btn-outline-secondary" for="dubi">Dự Bị
                                                    <input type="radio" name="hinhthuc[]" value="Dự bị" id="dubi">
                                                </label>
                                            {else}
                                                <label id="btn" class="btn btn-outline-secondary " for="chinhthuc">Chính Thức
                                                    <input  type="radio" name="hinhthuc[]" value="Chính thức" id="chinhthuc">
                                                </label>
                                                <label id="btn" class="btn btn-outline-secondary active" for="dubi">Dự Bị
                                                    <input checked type="radio" name="hinhthuc[]" value="Dự bị" id="dubi">
                                                </label>
                                            {/if}
                                        </div>
                                    </div>
                                </div>
                                {/if}
                                </div>
                                
                                
                                
                            </div> 
                            <div class="footer clearfix"> 
                                <button id="add-thisinh_submit" name="action" value="add-thisinh" type="submit" class="confirm btn btn-default">Cập nhật</button>
                            </div> 
                        </div> 
                    </div>
                </div>
            </div>
        </div>
    </div>
</form>
    <script>
        // Add active class to the current button (highlight it)
        var header = document.getElementById("btn");
        var btns = header.getElementsByClassName("btn-outline-secondary");
        for (var i = 0; i < btns.length; i++) {
          btns[i].addEventListener("click", function() {
          var current = document.getElementsByClassName("active");
          current[0].className = current[0].className.replace(" active", "");
          this.className += " active";
          });
        }
    </script>
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
