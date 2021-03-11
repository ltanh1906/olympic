<style>
input{
    width: 100%;
    border-color: black;
    margin-bottom: 10px;
    line-height: 40px;
    background: transparent;
    border-width: 0 0 2px;
    outline: none;
    font-weight: 500;
    font-size: 25px;
    transition: all 0.3s ease;
}
</style>
<div class="col-lg-12 content">
                <div class="login" style="">
                    <div class="login-header">
                    <i class="fa fa-lock" aria-hidden="true" style="font-size: 70px"></i>
                        <h1 style="font-weight: bold;">THAY ĐỔI MẬT KHẨU</h1>
                    </div>
                    <form class="form" id="form" action="" method="post">
                    <div class="login-form" style="width: 400px; border: none !important; text-align: center;">
                        <div class="col-lg-12" style="text-align: left;">
                            <h3><i class="fa fa-caret-right" aria-hidden="true"></i></i >Mật khẩu hiện tại:</h3>
                            <input type="password" name="current_pass" placeholder="Mật khẩu hiện tại"/><br>
                            <h3><i class="fa fa-caret-right" aria-hidden="true"></i></i> Mật khẩu mới:</h3>
                            <input type="password" name="new_pass" placeholder="Mật khẩu mới"/><br>
                            <h3><i class="fa fa-caret-right" aria-hidden="true"></i></i> Nhập lại mật khẩu mới:</h3>
                            <input type="password" name="new_repass" placeholder="Nhập lại mật khẩu mới"/>
                            <br>
                        </div>
                        <button type="submit" class="confirm btn btn-default">Thay đổi</button>
                    </div>
                    </form>
                </div>
            </div>
