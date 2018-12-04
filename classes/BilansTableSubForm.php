<?php
class BilansTableSubForm
{
    private $incomesTable = null;
    private $expensesTable = null;

    private $incomesSum = 0;
    private $expensesSum = 0;

    public function __construct() 
    {
        $tableColumns = array();
        array_push($tableColumns, 'Kategoria');
        array_push($tableColumns, 'Kwota');

        $this->incomesTable = new Table('Przychody', $tableColumns);
        $this->expensesTable = new Table('Wydatki', $tableColumns);
    }

    public function populateIncomesTable($incomeRows, $incomesSum)
    {
        $this->incomesTable->setRows($incomeRows); 
        $this->incomesSum = $incomesSum;
    }

    public function populateExpensesTable($expenseRows, $expensesSum)
    {
        $this->expensesTable->setRows($expenseRows);
        $this->expensesSum = $expensesSum;
    }

    function show()
    {
        echo '<div class="col-md-12 col-md-offset-1">
                <div class="'.FormatStyles::HALF_SIDE.'">';
                    $this->incomesTable->show();
        echo        '<div class="'.FormatStyles::STANDARD.'">
                        <h4>Suma:</h4>
                    </div>
                    <div class="'.FormatStyles::MIDDLE_TITLE.'">';
                        echo number_format($this->incomesSum, 2);
        echo        '</div>
                </div>
                <div class="'.FormatStyles::HALF_SIDE.'">';
                    $this->expensesTable->show();
        echo        '<div class="'.FormatStyles::STANDARD.'">
                        <h4>Suma:</h4>
                    </div>
                    <div class="'.FormatStyles::MIDDLE_TITLE.'">';
                        echo number_format($this->expensesSum, 2);
        echo        '</div>
                </div>
            </div>
            <div class="col-md-10 col-md-offset-1 text-center">
                <div class="'.FormatStyles::STANDARD.'">
                    <h4>Bilans:</h4>
                </div>
                <div class="'.FormatStyles::MIDDLE_TITLE.'">';
                    $bilans = $this->incomesSum - $this->expensesSum;
                    echo number_format($bilans, 2);
        echo    '</div>
                <div class="'.FormatStyles::MIDDLE_TITLE.'">';
                    if($bilans >= 0)
                    {
                        echo '<span class="text-info">Gratulacje. Świetnie zarządzasz finansami!</span>';
                    }
                    else
                    {
                        echo '<span class="text-danger">Uważaj, wpadasz w długi!</span>';
                    }
        echo    '</div>
            </div>';
    }
}