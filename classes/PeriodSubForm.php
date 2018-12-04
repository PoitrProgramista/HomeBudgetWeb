<?php
class PeriodSubForm
{
    private $selector = null;
    private $dateBegin = null;
    private $dateEnd = null;

    function __construct()
    {
        $this->selector = new Selector('period');
        $this->populateSelector();

        $this->dateBegin = new FormInput('begin', '', 'text', 'date', '');
        $this->dateEnd = new FormInput('end', '', 'text', 'date', '');   
    }

    function show()
    {
        echo '<form id="periodForm" method="post">
                <div class="col-md-4 col-md-offset-8 text-right">';
                    $this->selector->show();
        echo '  </div>';

        if(isset($_SESSION['rem_choice']))
            $choice = $_SESSION['rem_choice'];
        else
            $choice = null;

        echo '  <div id="userDate" class="col-md-4 col-md-offset-8 text-right input-group">
                    <div class="col-md-6 ">';
                        $this->dateBegin->show();
        echo '      </div>
                    <div class="col-md-6">';
                        $this->dateEnd->show();
        echo '      </div>';

        if (isset($_SESSION['e_date'])) 
        {
            echo '<div class="text-danger text-center">' . $_SESSION['e_date'] . '</div>';
            unset($_SESSION['e_date']);
        }
        
        echo '  </div>';
        echo '</form>';
    }

    function populateSelector()
    {
        $this->selector->addOption('currentMonth', 'Bieżący miesiąc');
        $this->selector->addOption('previousMonth', 'Poprzedni miesiąc');
        $this->selector->addOption('currentYear', 'Bieżący rok');
        $this->selector->addOption('userDefined', 'Niestandardowy');
    }
}