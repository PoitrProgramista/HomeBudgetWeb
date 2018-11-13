<?php
class Submit
{
    private $text = '';

    function __construct($text)
    {
        $this->text = $text;
    }

    function show()
    {
        echo    '<div class="col-md-2 col-md-offset-5 text-center">
                    <input type="submit" class="btn btn-success btn-md" value="'.$this->text.'">
                </div>';
    }
}

