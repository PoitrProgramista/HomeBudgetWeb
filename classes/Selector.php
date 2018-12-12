<?php
class Selector
{   
    private $multiplePick = false;
    private $name = '';
    private $options = array();

    function __construct($name, $multiplePick = false)
    {
        $this->name = $name;
        $this->multiplePick = $multiplePick;
    }

    function show()
    {
        echo '<select id="'.$this->name.'" class="form-control" name="'.$this->name.'"';

        if($this->multiplePick)
            echo ' multiple>';
        else
            echo '>';

        foreach ($this->options as $option)
            $option->show();

        echo  '</select>';
    }

    function addOption($value, $text)
    {
        $option = new SelectorOption($value, $text);

        array_push($this->options, $option);
    }
}

class SelectorOption
{
    private $value = '';
    private $text= '';

    function __construct($value, $text)
    {
        $this->value = $value;
        $this->text = $text;
    }

    function show()
    {
        if($_SESSION['rem_choice'] == $this->value)
            echo '<option selected value="'.$this->value.'">'.$this->text.'</option>';
        else
            echo '<option value="'.$this->value.'">'.$this->text.'</option>';
    }
}