<?php
abstract class Clickable
{
    protected $location = '';
    protected $text = '';
    protected $formatStyle = '';

    function __construct($location, $text, $formatStyle = FormatStyles::STANDARD)
    {
        $this->location = $location;
        $this->text = $text;
        $this->formatStyle = $formatStyle;
    }

    abstract protected function show();
}
