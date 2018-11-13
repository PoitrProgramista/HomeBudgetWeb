<?php
class RadioInput
{
    private $name = '';
    private $title = '';
    private $radioFormData = null;

    function __construct($radioFormData, $name, $title)
    {
        $this->name = $name;
        $this->title = $title;
        $this->radioFormData = $radioFormData;
    }

    function show()
    {
        echo '<div class="col-md-4 col-md-offset-4 text-center">
                <h4>'.$this->title.'</h4>';

                if(isset($_SESSION['error_'.$this->name]))
                {
                    echo '<div class="text-danger text-center">'.$_SESSION['error_'.$this->name].'</div>';
                    unset($_SESSION['error_'.$this->name]);
                }

        echo '</div>';
        

        echo '<div class="row">
                <div class="col-md-4 col-md-offset-4 text-left">';

        foreach ($this->radioFormData as $data) 
        {
            echo '<div class="radio">
                    <label>
                        <input type="radio" name="'.$this->name.'" value="'.$data['id'].'">'.$data['name'].'
                    </label>
                </div>';
        }

        echo '  </div>
            </div>';
    }
}
