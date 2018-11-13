<?php
abstract class Clickable
{
    protected $location = '';
    protected $text = '';

    function __construct($location, $text)
    {
        $this->location = $location;
        $this->text = $text;
    }

    abstract protected function show();
}
