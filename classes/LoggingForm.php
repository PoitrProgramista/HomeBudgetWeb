<?php
class LoggingForm
{
    private $elements = array();

    public function __construct()
    {
        array_push($this->elements, new FormInput('email', 'Email', 'text'));
        array_push($this->elements, new FormInput('password', 'Hasło', 'password'));
        array_push($this->elements, new Link('registration', 'Nie masz konta? Zarejestruj się.'));
        array_push($this->elements, new Submit('Dalej'));
    }

    public function showForm()
    {
        if(isset($_SESSION['registered']))
        {
            echo '<div class="text-center text-info">Rejestracja udana. Możesz się zalogować</div>';
            unset($_SESSION['registered']);
        }

        echo '<form method="post">';

        foreach ($this->elements as $input)
            $input->show();
            
        echo'</form>';
    }
}