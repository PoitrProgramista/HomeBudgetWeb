<?php
class AddExpenseForm
{
    private $portalBack = null;
    private $elements = array();
    private $parameterUserID =':userID';

    public function __construct($portalBack)
    {
        $this->portalBack = $portalBack;

        array_push($this->elements, new FormInput('amount','Kwota','text'));
        array_push($this->elements, new FormInput('date', 'Data', 'text', 'date'));
        array_push($this->elements, new RadioInput($this->getPaymentData(), 'payment', 'Sposób płatności'));
        array_push($this->elements, new RadioInput($this->getCategoryData(), 'category', 'Kategoria'));
        array_push($this->elements, new FormInput('comment', 'Komentarz', 'text'));
        array_push($this->elements, new Submit('Dalej'));
        array_push($this->elements, new SmallButton('mainMenu', 'Wróć'));
    }

    public function showForm()
    {
        echo '<div class="row">
                <div class="col-md-6 col-md-offset-3 text-center">
                    <h2>Dodawanie wydatku</h2>
                </div>
             </div>';

        if(isset($_SESSION['added']))
            echo '<div class="text-center text-info">Dodano.</div>';
     
        echo '<form method="post">';

        foreach ($this->elements as $input)
            $input->show();

        echo '</form>';
    }

    private function getPaymentData()
    {
        $query = "SELECT id,name FROM payment_methods_assigned_to_users WHERE user_id = ".$this->parameterUserID." ORDER BY position ASC";

        return $this->getRadioData($query);
    }

    private function getCategoryData()
    {
        $query = "SELECT id,name FROM expenses_category_assigned_to_users WHERE user_id = ".$this->parameterUserID." ORDER BY position ASC";

        return $this->getRadioData($query);
    }

    private function getRadioData($query)
    {
        $loggedUser = $this->portalBack->getLoggedUser();
        $userID = $loggedUser->getID();

        $arguments[$this->parameterUserID] = $userID;
        $queryResult = $this->portalBack->queryDatabase($query, $arguments);
        unset($arguments);

        return $queryResult->fetchAll();
    }
}