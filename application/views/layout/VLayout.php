<?php
    $user = getSession();
    $this->parser->parse('layout/Vheader',$page);
    
    echo '<div class="wrapper">';
        $this->parser->parse('layout/Vmenu');
        if(isset($slide)){
            $this->parser->parse($slide, $carousel);
        }
        echo '<div class="body  col-lg-12">';
            $this->parser->parse($left, $dLeft);
            if(isset($right)){
                $this->parser->parse($right);
            }
            if(isset($album)){
                $this->parser->parse($album);
            }
        echo '</div>';
    echo '</div>';
    echo '<div class="address_detail address_detail col-lg-12">';
        $this->parser->parse('layout/Vfooter', $messages); 
    echo '</div>';
    
?>