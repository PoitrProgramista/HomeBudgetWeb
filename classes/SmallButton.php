<?php
class SmallButton extends Clickable
{
    function show()
    {
        echo '<div class="row">
                <div class="col-md-2 col-md-offset-5 text-center mb-1">
                       <a class="btn btn-success btn-md" href="index.php?state='.$this->location.'">'.$this->text.'</a>
                </div>
             </div>';
    }
}
