<div class="banner">
        <img src="{public_url('site')}/img/olympicbanner1.png" width="100%" alt="">
    </div>

    <!-- Search Navbar - START -->
    <nav class="navbar navbar-default" role="navigation">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
        </div>
        <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
            <div class="menu col-sm-12 col-md-12">
                <ul class="nav navbar-nav">
                    <li class="btn_menu"><a href="{base_url('Chome')}"><i class="fa fa-home" aria-hidden="true"></i></a></li>
                    <li class="btn_menu" ><a href="{base_url('Chome/gioithieu')}">Giới thiệu</a></li>
                    <li class="btn_menu"><a href="{base_url('Chome/thongbao')}">Thông báo</a></li>
                    <li class="btn_menu"><a href="{base_url('Chome/tochuc')}">Tổ chức</a></li>
                    <li class="btn_menu"><a href="{base_url('Chome/ontap')}">Ôn tập</a></li>
                    <li class="btn_menu"><a href="{base_url('Chome/album')}">Album</a></li>
                    <li class="btn_menu"><a href="{base_url('Chome/dvdangcai')}">Đơn vị đăng cai</a></li>
                    <li class="btn_menu"><a href="{base_url('Chome/danhsach')}">Danh sách</a></li>
                    <li class="btn_menu"><a href="{base_url('Cform')}">Đăng ký</a></li>

                </ul>
            </div>      
        </div>
        <div class="container-fluid py-2">
                    <div class="inn-user-menu__nav__avatar-btn">
                            <span class="inn-user-menu__nav__avatar-btn__link" style="float: right;">
                            <i class="fa fa-user-circle" aria-hidden="true" style="font-size: 40px;
    margin-top: 5px;
    margin-right: 10px; color: white;"></i>
                            </span>
                            {$user = getSession()}
                            {if isset($user)}
                                <div class="inn-user-menu__nav">
                                <div class="inn-user-menu__nav__portal">
                                    <a title="" class="inn-user-menu__nav__portal__item" href="">
                                    <span style="color: white;">{$user->sTenTaiKhoan}</span>
                                    </a>
                                </div>
                                <div class="inn-user-menu__nav__item__container">
                                    <div class="action-menu">
                                    <div class="icon">
                                        <div class="inn-icon">
                                            <i class="fa fa-file-text" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="text"><p>Hồ sơ</p></div>
                                    <a href="{base_url('Cform')}"><i class="fa fa-plus" aria-hidden="true"></i><span>Thêm</span></a>
                                    <a href="{base_url('Clist')}"><i class="fa fa-exchange" aria-hidden="true"></i><span>Danh sách</span></a>
                                    </div>
                                    
                                    <div class="action-menu">
                                    <div class="icon">
                                        <div class="inn-icon">
                                            <i class="fa fa-user-circle-o" aria-hidden="true"></i>
                                        </div>
                                    </div>
                                    <div class="text"><p>Tài khoản</p></div>
                                    <a href="{base_url('Clogin/changepass')}"><i class="fa fa-key" aria-hidden="true"></i><span>Đổi mật khẩu</span></a>
                                    <a href="{base_url('Clogin/logout')}"><i class="fa fa-power-off" aria-hidden="true"></i><span>Đăng xuất</span></a>
                                    </div>
                                </div>     
                            </div>
                            {else}
                                <div class="inn-user-menu__nav" style="width: 300px;">
                                <div class="inn-user-menu__nav__portal">
                                    <a title="" class="inn-user-menu__nav__portal__item" href="">
                                    <span style="color: white;">Chưa đăng nhập</span>
                                    </a>
                                </div>
                                <div class="inn-user-menu__nav__item__container">
                                    
                                    <div class="action-menu" style="width:100%" href="#">
                                        <div class="icon">
                                            <div class="inn-icon" style="width: 6rem;
    height: 6rem;
    font-size: 40px; line-height: unset">
                                                <i class="fa fa-sign-in" aria-hidden="true"></i>
                                            </div>
                                        </div>
                                        
                                        <a href="{base_url('Clogin')}" style="text-align: center"><span>> Đăng nhập <</span></a>
                                    </div>
                                    
                                </div>     
                            </div>
                            {/if}
                    </div>
                </div>
    </nav>