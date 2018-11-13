<?php
class MainMenuForm
{
    private $elements = array();

    public function __construct()
    {
        array_push($this->elements, new BigButton('addIncome', 'Dodaj przychód'));
        array_push($this->elements, new BigButton('addExpense', 'Dodaj wydatek'));
        array_push($this->elements, new BigButton('bilans', 'Przeglądaj bilans'));
        array_push($this->elements, new BigButton('settings', 'Ustawienia'));
        array_push($this->elements, new BigButton('logout', 'Wyloguj'));
    }

    public function showForm()
    {
        foreach ($this->elements as $input)
            $input->show();
    }
}