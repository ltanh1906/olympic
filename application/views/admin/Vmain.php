<?php $data['currentUrl'] = str_replace(base_url(), '', current_url()); 
echo '<!DOCTYPE html>';
echo '<html lang="en">';
echo '<head>';
    
    $this->parser->parse('admin/Vhead');
echo '</head>';
echo '<body>';
echo    '<div id="rightSide">';
        if(!isset($login))
        $this->parser->parse('admin/Vheader');
        $this->parser->parse($temp, $dtemp);


        $this->parser->parse('admin/Vfooter');
echo   '</div>';
echo    '<div class="clear"></div>';
echo '</body>';
echo '</html>';
?>