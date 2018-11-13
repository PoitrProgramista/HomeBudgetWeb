<?php
class BilansForm
{
    private $portalBack = null;
    private $elements = array();
    private $parameterUserID =':userID';

    public function __construct($portalBack)
    {
        $this->portalBack = $portalBack;

        array_push($this->elements, new PeriodSubForm());
        array_push($this->elements, new SmallButton('mainMenu', 'Wróć'));
    }

    public function showForm()
    {
        echo '<div class="col-md-6 col-md-offset-3 text-center">
                    <h2>Przeglądanie bilansu</h2>
            </div>';

        if(isset($_SESSION['added']))
            echo '<div class="text-center text-info">Dodano.</div>';
     
        foreach ($this->elements as $input)
            $input->show();
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