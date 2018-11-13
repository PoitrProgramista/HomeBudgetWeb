<?php
class Submit
{
    private $text = '';
    private $formatStyle = '';

    function __construct($text, $formatStyle = FormatStyles::STANDARD)
    {
        $this->text = $text;
        $this->formatStyle = $formatStyle;
    }

    function show()
    {
        echo '<div class="'.$this->formatStyle.'">
                <input type="submit" class="btn btn-success btn-md" value="'.$this->text.'">
            </div>';
    }
}

