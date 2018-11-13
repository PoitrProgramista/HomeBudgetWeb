<?php
class BigButton extends Clickable
{
    function show()
    {
        echo '<div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                       <a class="btn btn-success btn-lg" href="index.php?state='.$this->location.'">'.$this->text.'</a>
                </div>
             </div>';
    }
}
