<?php
class FormInput
{
    private $title = '';
    private $name = '';
    private $type = '';
    private $class = '';
    private $text = '';

    function __construct($name, $title, $type, $class = '', $text = '')
    {
        $this->title = $title;
        $this->name = $name;
        $this->type = $type;
        $this->class = $class;
        $this->text = $text;
    }

    function show()
    {
        if (isset($_SESSION['rem_'.$this->name]))
        {
            $textToShow = $_SESSION['rem_'.$this->name];
            unset($_SESSION['rem_'.$this->name]);
        }
        else
            $textToShow  = $this->text;

        echo '<div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">
                    <label class="control-label" >'.$this->title.'</label>
                    <input class="'.$this->class.' form-control" name="'.$this->name.'" type="'.$this->type.'" value="'.$textToShow.'">
                </div>
             </div>';

        if(isset($_SESSION['error_'.$this->name]))
        {
            echo '<div class="text-danger text-center">' . $_SESSION['error_'.$this->name] . '</div>';
            unset($_SESSION['error_'.$this->name]);
        }
    }
}
