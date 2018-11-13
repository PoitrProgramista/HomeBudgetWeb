<?php
class Registration
{
    private $userID;
    private $valid = true;
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
        $name = $_POST['name'];
        $email = $_POST['email'];
        $password = $_POST['password'];

        $this->valid &= $this->validateName($name);
        $this->valid &= $this->validatePassword($password);
        $this->valid &= $this->validateEmail($email);
        $this->valid &= $this->isEmailFree($email);
        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        if ($this->valid)
        {
            $this->addUser($name, $passwordHash, $email);
            $this->addDefaultIncomes();
            $this->addDefaultExpenses();
            $this->addDefaultPaymentMethods();

            $_SESSION['registered'] = true;

            header('Location: index.php?state=login');
        }
        else
        {
            $_SESSION['rem_name'] = $name;
            $_SESSION['rem_email'] = $email;
        }
    }

    private function validateName($name)
    {
        if ((strlen($name) < 2) || (strlen($name) > 20))
        {
            $_SESSION['error_name'] = "Imię musi posiadać od 2 do 20 znaków";

            return false;
        }

        if (ctype_alpha($name) == false)
        {
            $_SESSION['error_name'] = "Imię może składać się tylko z liter (bez polskich znaków)";

            return false;
        }

        return true;
    }

    private function validateEmail($email)
    {
        $emailFiltered = filter_var($email, FILTER_SANITIZE_EMAIL);

        if ((filter_var($emailFiltered, FILTER_VALIDATE_EMAIL) == false) || ($emailFiltered != $email))
        {
            $_SESSION['error_email'] = "Podaj poprawny adres e-mail";

            return false;
        }

        return true;
    }

    private function validatePassword($password)
    {
        if ((strlen($password) < 8) || (strlen($password) > 20))
        {
            $_SESSION['error_password'] = "Hasło musi posiadać od 8 do 20 znaków";

            return false;
        }

        return true;
    }

    private function isEmailFree($email)
    {
        $arguments[$this->parameterEmail] = $email;
        $query = "SELECT id FROM users WHERE email=".$this->parameterEmail;
        $queryResult = $this->portalBack->queryDatabase($query, $arguments);
        unset($arguments);

        $duplicateEmailsCount = $queryResult->rowCount();

        if ($duplicateEmailsCount > 0)
        {
            $_SESSION['error_email'] = "Podaj poprawny adres e-mail";

            return false;
        }
        else
            return true;
    }

    private function addUser($name, $passwordHash, $email)
    {
        $arguments[$this->parameterUsername] = $name;
        $arguments[$this->parameterPassword] = $passwordHash;
        $arguments[$this->parameterEmail] = $email;

        $query = "INSERT INTO users VALUES (NULL,".$this->parameterUsername.",".$this->parameterPassword.",".$this->parameterEmail.")";
        $this->userID = $this->portalBack->insertToDatabase($query, $arguments);
        unset($arguments);
    }

    private function addDefaultIncomes()
    {
        $result = $this->portalBack->queryDatabase("SELECT name,position FROM incomes_category_default");
        $query = "INSERT INTO incomes_category_assigned_to_users VALUES (NULL,".$this->parameterUserID.",".$this->parameterName.",".$this->parameterPosition.")";
        $this->assignDefaultToUser($query, $result->fetchAll());
    }

    private function addDefaultExpenses()
    {
        $result = $this->portalBack->queryDatabase("SELECT name,position FROM expenses_category_default");
        $query = "INSERT INTO expenses_category_assigned_to_users VALUES (NULL,".$this->parameterUserID.",".$this->parameterName.",".$this->parameterPosition.")";
        $this->assignDefaultToUser($query, $result->fetchAll());
    }

    private function addDefaultPaymentMethods()
    {
        $result = $this->portalBack->queryDatabase("SELECT name,position FROM payment_methods_default");
        $query = "INSERT INTO payment_methods_assigned_to_users VALUES (NULL,".$this->parameterUserID.",".$this->parameterName.",".$this->parameterPosition.")";
        $this->assignDefaultToUser($query, $result->fetchAll());
    }

    private function assignDefaultToUser($query, $categories)
    {
        foreach ($categories as $category)
        {
            $arguments[$this->parameterUserID] = $this->userID;
            $arguments[$this->parameterName] = $category['name'];
            $arguments[$this->parameterPosition] = $category['position'];
            $this->portalBack->insertToDatabase($query, $arguments);
            unset($arguments);
        }
    }
}
