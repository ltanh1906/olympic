            <div class="main_left col-lg-8">
                <div class="b_left col-lg-12">
                    <div class="l_content baiviet col-lg-12">
                        <div class="text-box">
                            <p class="alignleft"><a href="{home_url($link_dm)}">{$baiviet->sTenLoaiTin}</a></p>
                            <h3 style="    margin-top: 0px !important;
    margin-bottom: 0px !important;     font-weight: bold;">{$baiviet->sTieuDe}</h3>
                            <p class=""><i class="fa fa-calendar" aria-hidden="true"></i> {date("d-m-Y", $baiviet->dNgayDang)}</p>
                        </div>
                        <div style="clear: both;"></div>
                        <div class="panel-body in-danhmuc nd-thongbao">
                            <div class="noidung" style="text-align: justify">
                                {$baiviet->tNoiDung}
                            </div>
                            <div class="lienquan">
                                <h4><b>Tin liên quan</b></h4>
                                <ul>
                                    {foreach $relate as $r}
                                        {if $r.sIDBaiviet != $baiviet->sIDBaiviet}
                                        <li><a href="{base_url('Cbaiviet/view/')}{$r.sIDBaiviet}">{$r.sTieuDe}</a></li>
                                        {/if}
                                    {/foreach}
                                    
                                </ul>
                            </div>
                        </div>
                    </div>
                    
                </div>
            </div>