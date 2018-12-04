<?php
class Bilans
{
    private $userID;
    private $portalBack = null;
    private $bilansForm = null;
    private $parameterUserID =':userID';
    private $parameterCategoryID =':categoryID';
    private $parameterBegin = ':begin';
    private $parameterEnd =':end';

    public function __construct($portalBack, $bilansForm)
    {
        $this->portalBack = $portalBack;
        $this->bilansForm = $bilansForm;
    }

    public function submit()
    {
        unset($_SESSION['added']);
        
        $periodChoice = $_POST['period'];
        $_SESSION['rem_choice'] = $periodChoice;

        $valid = true;
        switch ($periodChoice) 
        {
            case "currentMonth":
                $begin = date('Y-m-01');
                $end = date('Y-m-t');
                break;

            case "previousMonth":
                $begin = date('Y-m-d', strtotime('first day of previous month'));
                $end = date('Y-m-d', strtotime('last day of previous month'));
                break;

            case "currentYear":
                $begin = date('Y-01-01');
                $end = date('Y-12-31');
                break;

            case "userDefined":
                $begin = $_POST['begin'];
                $end = $_POST['end'];
                $_SESSION['rem_begin'] = $begin;
                $_SESSION['rem_end'] = $end;

                $valid = ValidityTools::validateDate($begin) && ValidityTools::validateDate($end) && ValidityTools::validatePeriod($begin, $end);

                if($valid == false)
                    $_SESSION['e_date'] = "Podaj poprawne daty";

                break;
        }

        if($valid)
        {
            $this->getIncomesForPeriod($begin, $end);
            $this->getExpensesForPeriod($begin, $end);
        }
    }

    function getIncomesForPeriod($begin, $end)
    {
        $userCategories = $this->getIncomeCategories();

        $incomesSum = 0;

        foreach ($userCategories as $userCategory) 
        {
            $categoryID = $userCategory['id'];
            $incomesCategorySum = $this->getIncomesCategorySum($categoryID, $begin, $end);

            $incomesSum = $incomesSum + $incomesCategorySum[0];
            if ($incomesCategorySum[0] == 0) 
                $incomesCategorySum[0] = '0';

            $incomesArray[$userCategory['name']] = $incomesCategorySum[0];
        }

        arsort($incomesArray);

        $this->bilansForm->populateIncomesTable($incomesArray, $incomesSum);
    }

    function getIncomeCategories()
    {
        $loggedUser = $this->portalBack->getLoggedUser();
        $userID = $loggedUser->getID();

        $arguments[$this->parameterUserID] = $userID;
        $query = "SELECT id,name FROM incomes_category_assigned_to_users WHERE user_id = ".$this->parameterUserID." ORDER BY position ASC";
        $queryResult = $this->portalBack->queryDatabase($query, $arguments);
        unset($arguments);

        return $queryResult->fetchAll();
    }

    function getIncomesCategorySum($categoryID, $begin, $end)
    {
        $arguments[$this->parameterCategoryID] = $categoryID;
        $arguments[$this->parameterBegin] = $begin;
        $arguments[$this->parameterEnd] = $end;
        $query = "SELECT SUM(amount) FROM incomes WHERE income_category_assigned_to_user_id = ".$this->parameterCategoryID." AND date BETWEEN ".$this->parameterBegin." AND ".$this->parameterEnd;
        $queryResult = $this->portalBack->queryDatabase($query, $arguments);
        unset($arguments);

        return $queryResult->fetch();
    }

    function getExpensesForPeriod($begin, $end)
    {
        $userCategories = $this->getExpenseCategories();

        $expensesSum = 0;

        foreach ($userCategories as $userCategory) 
        {
            $categoryID = $userCategory['id'];
            $expensesCategorySum = $this->getExpensesCategorySum($categoryID, $begin, $end);

            $expensesSum = $expensesSum + $expensesCategorySum[0];
            if ($expensesCategorySum[0] == 0) 
                $expensesCategorySum[0] = '0';

            $expensesArray[$userCategory['name']] = $expensesCategorySum[0];
        }

        arsort($expensesArray);

        $this->bilansForm->populateExpensesTable($expensesArray, $expensesSum);
        $this->bilansForm->populatePieChart($expensesArray);
    }

    function getExpenseCategories()
    {
        $loggedUser = $this->portalBack->getLoggedUser();
        $userID = $loggedUser->getID();

        $arguments[$this->parameterUserID] = $userID;
        $query = "SELECT id,name FROM expenses_category_assigned_to_users WHERE user_id = ".$this->parameterUserID." ORDER BY position ASC";
        $queryResult = $this->portalBack->queryDatabase($query, $arguments);
        unset($arguments);

        return $queryResult->fetchAll();
    }

    function getExpensesCategorySum($categoryID, $begin, $end)
    {
        $arguments[$this->parameterCategoryID] = $categoryID;
        $arguments[$this->parameterBegin] = $begin;
        $arguments[$this->parameterEnd] = $end;
        $query = "SELECT SUM(amount) FROM expenses WHERE expense_category_assigned_to_user_id = ".$this->parameterCategoryID." AND date BETWEEN ".$this->parameterBegin." AND ".$this->parameterEnd;
        $queryResult = $this->portalBack->queryDatabase($query, $arguments);
        unset($arguments);

        return $queryResult->fetch();
    }
}
