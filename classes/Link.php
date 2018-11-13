<?php
class Link extends Clickable
{
    function show()
    {
        echo '<div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                       <a href="index.php?state='.$this->location.'">'.$this->text.'</a>
                </div>
             </div>';
    }
}
