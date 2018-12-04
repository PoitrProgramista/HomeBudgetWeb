<?php
class BilansForm
{
    private $portalBack = null;
    private $elements = array();
    private $parameterUserID =':userID';

    public function __construct($portalBack)
    {
        $this->portalBack = $portalBack;

        $this->elements['periodForm'] = new PeriodSubForm();
        $this->elements['tablesForm'] = new BilansTableSubForm();
        $this->elements['pieChart'] = new PieChart();
        $this->elements['return']  = new SmallButton('mainMenu', 'Wróć');
    }

    public function showForm()
    {
        echo '<div class="'.FormatStyles::MIDDLE_TITLE.'">
                    <h2>Przeglądanie bilansu</h2>
            </div>';

        if(isset($_SESSION['added']))
            echo '<div class="text-center text-info">Dodano.</div>';
     
        foreach ($this->elements as $input)
            $input->show();
    }

    public function populateIncomesTable($incomeRows, $incomesSum)
    {
        $this->elements['tablesForm']->populateIncomesTable($incomeRows, $incomesSum);
    }

    public function populateExpensesTable($expenseRows, $expensesSum)
    {
        $this->elements['tablesForm']->populateExpensesTable($expenseRows, $expensesSum);
    }

    public function populatePieChart($expensesArray)
    {
        $this->elements['pieChart']->populatePieChart($expensesArray);
    }
}