<?php
class Selector
{
    private $name = '';
    private $options = array();

    function __construct($name)
    {
        $this->name = $name;
    }

    function show()
    {
        echo '<select id="'.$this->name.'" class="form-control" name="'.$this->name.'">';
        
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