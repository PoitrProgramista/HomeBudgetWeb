<?php
class BigButton extends Clickable
{
    function show()
    {
        echo '<div class="row">
                <div class="'.$this->formatStyle.'">
                       <a class="btn btn-success btn-lg" href="index.php?state='.$this->location.'">'.$this->text.'</a>
                </div>
             </div>';
    }
}
