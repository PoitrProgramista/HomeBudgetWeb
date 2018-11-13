<?php
class Logging
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
        $email = $_POST['email'];
        $password = $_POST['password'];

        $valid = $this->validateUser($email, $password);

        if ($valid)
        {
            $_SESSION['UserLogged'] = true;

            $userData = $this->findUser($email);
            $this->portalBack->setLoggedUser(new User($userData['id'], $userData['username']));

            header('Location: index.php?state=mainMenu');   
        }
        else
        {
            $_SESSION['rem_email'] = $email;

            return null;
        }
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
