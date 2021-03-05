<div class="main_left col-lg-8">
    <div class="b_left col-lg-12">
        <div class="l_content col-lg-12">
            <div class="tit-thongbao">
                <div class="clearfix vi-header">
                    <div class="vi-left-title pull-left">
                        <img src="{public_url('site')}/img/{$img_title}" alt="">
                    </div>
                </div>
            </div>
            <div class="panel-body nd-thongbao">
                {foreach $list as $r}
                <div class="tintuc row">
                    <div class="icon col-lg-2">
                        <img src="{public_url('site')}/img/Olympic logo.png" alt="">
                    </div>
                    <div class="tieude re-tieude col-lg-10">
                        <a href="{base_url('Cbaiviet/view/')}{$r.sIDBaiviet}">{$r.sTieuDe}</a>
                        <div class="date">
                            <i class="fa fa-calendar" aria-hidden="true"> {date("d-m-Y", $r.dNgayDang)}</i>
                        </div>
                    </div>
                </div>
                {/foreach}
            </div>
            
        </div>
        
    </div>
</div>