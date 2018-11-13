<?php
class RegistrationForm
{  
    private $elements = array();

    public function __construct()
    {
        array_push($this->elements, new FormInput('name', 'Imie', 'text'));
        array_push($this->elements, new FormInput('email', 'Email', 'text'));
        array_push($this->elements, new FormInput('password', 'Hasło', 'password'));
        array_push($this->elements, new Link('login', 'Masz już konto? Zaloguj się.'));
        array_push($this->elements, new Submit('Dalej'));
    }

    public function showForm()
    {
        echo '<form method="post">';

        foreach ($this->elements as $input)
            $input->show();
            
        echo'</form>';
    }
}
