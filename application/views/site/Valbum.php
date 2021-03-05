                    <div class="main_left col-lg-12">
                        <div class="b_left col-lg-12">
                            <div class="l_content col-lg-12 album">
                                <div class="tit-thongbao">
                                    <div class="clearfix vi-header">
                                        <div class="vi-left-title pull-left">
                                            <img src="{public_url('site')}/img/t-album.png" alt="">
                                            <!-- <div class="thongbao">Thông báo</div> -->
                                        </div>
                                    </div>
                                </div>
                                <div class="panel-body nd-thongbao">
                                {foreach $anh as $r}
                                    <div class="img col-lg-3">
                                        <img class="inn-album" src="{base_url('upload/slide/')}{$r.sLink}"
                                         class="fluid btn btn-info btn-lg" width="100%" alt="" data-toggle="modal" data-target="#myModal{$r.sIDAnh}">
                                        <figcaption style="
    font-size: 13px; padding-top: 10px !important;
    text-align: center !important;
    padding-bottom: 15px !important;
" class="figure-caption text-center">{$r.sMoTa}</figcaption>
                                        <div class="modal fade" id="myModal{$r.sIDAnh}" role="dialog">
                                            <div class="modal-dialog">
                                                <!-- Modal content-->
                                                <div class="modal-content">
                                                    <div class="modal-header">
                                                        <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                        <img class="hide-album" src="{base_url('upload/slide/')}{$r.sLink}" class="fluid modal-title" height="100% !important" width="100% !important" alt="">
                                                        <figcaption  class="figure-caption text-center">{$r.sMoTa}</figcaption>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    {/foreach}
                                </div>
                            </div>
                        </div>
                    </div>
                    