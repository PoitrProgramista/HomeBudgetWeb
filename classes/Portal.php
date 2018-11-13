<?php
class Portal
{
    private $portalBack  = null;
    private $action = null;
    private $loggedUser = null;
    private $form = null;

    function __construct()
    {
        $this->portalBack = new PortalBack();
    }

    function submit()
    {
        $this->action->submit();
        $this->loggedUser = $this->portalBack->getLoggedUser();           
    }

    function registration()
    {
        $this->form = new RegistrationForm();

        $this->action = new Registration($this->portalBack);
    }

    function logging()
    {
        $this->form = new LoggingForm();
        $this->action = new Logging($this->portalBack);
    }

    function createMainMenu()
    {
        $this->form = new MainMenuForm();
        $this->action = null;
    }

    function addIncome()
    {
        $this->form = new AddIncomeForm($this->portalBack);
        $this->action = new AddIncome($this->portalBack); 
    }

    function addExpense()
    {
        $this->form = new AddExpenseForm($this->portalBack);
        $this->action = new AddExpense($this->portalBack); 
    }

    function bilans()
    {
        $this->form = new BilansForm($this->portalBack);
        $this->action = new Bilans($this->portalBack); 
    }

    function showForm()
    {
        $this->form->showForm();
    }

    public function getTitle()
    {
       echo '<div class="row">
                <div class="col-md-4 col-md-offset-4 text-center">';

        if(is_a($this->action, "Logging"))
            echo '<h2>Logowanie</h2>';
        elseif(is_a($this->action, "Registration"))
            echo '<h2>Rejestracja</h2>';
        else
            $this->showLoggedUserName();

        echo '  </div>
            </div>';
    }

    function showLoggedUserName()
    {
        echo '<h3>';
            echo $this->loggedUser->getName();
        echo '</h3>';
    }

    function logout()
    {
        $this->loggedUser = null;
        $this->portalBack->setLoggedUser(null);
        $_SESSION['UserLogged'] = false;

        header('Location: index.php?state=login');
    }
}
