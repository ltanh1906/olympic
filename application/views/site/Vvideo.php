<div class="main_left col-lg-12">
    <div class="b_left col-lg-12">
        <div class="l_content col-lg-12 album">
            <div class="tit-thongbao">
                <div class="clearfix vi-header">
                    <div class="vi-left-title pull-left">
                        <img src="{public_url('site')}/img/t-video.png" alt="">
                        <!-- <div class="thongbao">Thông báo</div> -->
                    </div>
                </div>
            </div>
            <div class="panel-body nd-thongbao">
            {foreach $listvid as $r}
            <div class="col-lg-3 col-md-4 col-sm-6 px-2 py-2" style="overflow: hidden;">
                <div class="yturl">{$r.sLink}</div>
                <div class="text-center mt-3">
                    <span>{$r.sMoTa}</span>
                </div>
            </div>
                {/foreach}
            </div>
        </div>
    </div>
</div>

<script>

$("div.yturl").each(function(){
    var regex = /(\?v=|\&v=|\/\d\/|\/embed\/|\/v\/|\.be\/)([a-zA-Z0-9\-\_]+)/;
    var youtubeurl = $(this).text();
    var regexyoutubeurl = youtubeurl.match(regex);
    if (regexyoutubeurl) 
    {
         $(this).html("<iframe width=\"\" height=\"\" src=\"http://www.youtube.com/embed/"+regexyoutubeurl[2]+"\" frameborder=\"0\" allowfullscreen></iframe>");
    }
});
</script>
                    