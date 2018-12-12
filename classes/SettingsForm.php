<?php
class SettingsForm
{
    private $portalBack = null;
    private $elements = array();
    private $parameterUserID =':userID';

    public function __construct($portalBack)
    {
        $this->portalBack = $portalBack;

        $this->incomeCategorySelector = new Selector('incomeCategories', true);
        $this->populateIncomeSelector();

    }

    public function showForm()
    { 
        echo '<div class="'.FormatStyles::MIDDLE_TITLE.'">
                <h2>Ustawienia</h2>
            </div>';
        //echo '<div class="'.FormatStyles::STANDARD.'">';
        //        $this->incomeCategorySelector->show();
        //echo'</div>';
        $this->settingsMenuSubForm();

        foreach ($this->elements as $input)
            $input->show();
    }

    public function settingsMenuSubForm()
    {
        $this->elements['changeUserData']  = new BigButton('settings', 'Dane użytkownika');
        $this->elements['changeCategories']  = new BigButton('settings', 'Kategorie i sposoby płatności');
        $this->elements['changeLastIncomes']  = new BigButton('settings', 'Ostatnie przychody');
        $this->elements['changeLastExpenses']  = new BigButton('settings', 'Ostatnie wydatki');
        $this->elements['return']  = new SmallButton('mainMenu', 'Wróć');
    }

    function populateIncomeSelector()
    {
        $this->incomeCategorySelector->addOption('currentMonth', 'Bieżący miesiąc');
        $this->incomeCategorySelector->addOption('previousMonth', 'Poprzedni miesiąc');
        $this->incomeCategorySelector->addOption('currentYear', 'Bieżący rok');
        $this->incomeCategorySelector->addOption('userDefined', 'Niestandardowy');
    }
}