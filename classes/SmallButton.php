<?php
class SmallButton extends Clickable
{
    function show()
    {
        echo '<div class="row">
                <div class="'.$this->formatStyle.'">
                       <a class="btn btn-success btn-md" href="index.php?state='.$this->location.'">'.$this->text.'</a>
                </div>
             </div>';
    }
}
