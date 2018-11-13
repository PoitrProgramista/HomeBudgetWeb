<?php
class Bilans
{
    private $userID;
    private $portalBack = null;
    private $parameterUsername = ':username';
    private $parameterPassword = ':password';
    private $parameterEmail = ':email';
    private $parameterUserID =':userID';
    private $parameterName = ':name';
    private $parameterPosition =':position';

    public function __construct($portalBack)
    {
        $this->portalBack = $portalBack;
    }

    public function submit()
    {
        $_SESSION['rem_choice'] = $_POST['period'];
    }

    private function validateUser($email, $password)
    {
        $emailFiltered = filter_var($email, FILTER_SANITIZE_EMAIL);
        if ((filter_var($emailFiltered, FILTER_VALIDATE_EMAIL) == false) || ($emailFiltered != $email))
        {
            $_SESSION['error_email'] = "Podaj poprawny adres e-mail";

            return false;
        }

        $user = $this->findUser($emailFiltered);
        if($user == null)
        {
            $_SESSION['error_email'] = "Brak podanego adresu email w bazie.";

            return false;
        }

        if(password_verify($password, $user['password']))
        {
            return true;
        }
        else
        {
            $_SESSION['error_password'] = "Błędne hasło.";

            return false;
        }
    }

    private function findUser($email)
    {
        $arguments[$this->parameterEmail] = $email;
        $query = "SELECT id, username, password FROM users WHERE email=".$this->parameterEmail;
        $queryResult = $this->portalBack->queryDatabase($query, $arguments);
        unset($arguments);

        return $queryResult->fetch();
    }
}
