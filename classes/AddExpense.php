<?php
class AddExpense
{
    private $loggedUserID;
    private $portalBack = null;
    private $parameterUserID =':userID';
    private $parameterExpenseCategory = ':expenseCategory';
    private $parameterPaymentMethod = ':paymentMethod';
    private $parameterAmount = ':amount';
    private $parameterDate = ':date';
    private $parameterComment = ':comment';

    public function __construct($portalBack)
    {
        $this->portalBack = $portalBack;
    }

    public function submit()
    {
        unset($_SESSION['added']);
        
        $amount = $_POST['amount'];
        $date = $_POST['date'];

        $valid = $this->validateForm($amount, $date);

        if ($valid)
        {
            $loggedUser= $this->portalBack->getLoggedUser();
            $userID = $loggedUser->getID();
            $expenseCategory = $_POST['category'];
            $paymentMethod = $_POST['payment'];
            $comment = $_POST['comment'];

            $this->addexpense($userID, $expenseCategory, $paymentMethod, $amount, $date, $comment);

            $_SESSION['added'] = true;

            header('Location: index.php');
        }
        else
        {
            $_SESSION['rem_amount'] = $amount;
            $_SESSION['rem_comment'] = $_POST['comment'];
        }
    }

    private function addExpense($userID, $expenseCategory, $paymentMethod, $amount, $date, $comment)
    {
        $arguments[$this->parameterUserID] = $userID;
        $arguments[$this->parameterExpenseCategory] = $expenseCategory;
        $arguments[$this->parameterPaymentMethod] = $paymentMethod;
        $arguments[$this->parameterAmount] = $amount;
        $arguments[$this->parameterDate] = $date;
        $arguments[$this->parameterComment] = $comment;

        $query = "INSERT INTO expenses VALUES (NULL, ".$this->parameterUserID.", ".$this->parameterExpenseCategory.", ".$this->parameterPaymentMethod.", ".$this->parameterAmount.", ".$this->parameterDate.", ".$this->parameterComment.")";
        $this->portalBack->insertToDatabase($query, $arguments);
        unset($arguments);
    }

    function validateForm($amount, $date)
    {
        $valid = true;

        if (!ValidityTools::isCurrency($amount)) 
        {
            $valid = false;
            $_SESSION['error_amount'] = "Podaj poprawną kwotę";
        }
    
        if (!ValidityTools::validateDate($date)) 
        {
            $valid = false;
            $_SESSION['error_date'] = "Podaj poprawną datę";
        }
    
        if (!isset($_POST['category']))
        {
            $valid = false;
            $_SESSION['error_category'] = "Musisz wybrać kategorię";
        }

        if (!isset($_POST['payment']))
        {
            $valid = false;
            $_SESSION['error_payment'] = "Musisz wybrać sposób płatności";
        }

        return $valid;
    }
}