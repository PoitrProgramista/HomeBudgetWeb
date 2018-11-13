<?php
class Link extends Clickable
{
    function show()
    {
        echo '<div class="row">
                <div class="'.$this->formatStyle.'">
                       <a href="index.php?state='.$this->location.'">'.$this->text.'</a>
                </div>
             </div>';
    }
}
