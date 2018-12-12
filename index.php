<?php 
spl_autoload_register('classLoader');
session_start();

if(!isset($_SESSION['portal']))
    $_SESSION['portal'] = new Portal();

if (!isset($_GET['state']))
    $_GET['state'] = 'login';

if (!isset($_SESSION['UserLogged']))
    $_SESSION['UserLogged'] = false;

try
{
    include "html/header.html";

    $portal = $_SESSION['portal'];

    if(!$_SESSION['UserLogged'])
    {
        switch($_GET['state'])
        {
            case 'registration':
                $portal->registration();
                break;
            case 'login':
                $portal->logging();
                break;
        }

        include 'templates/smallContainer.php';
    }
    else
    {
        switch($_GET['state'])
        {
            case 'mainMenu':
                $portal->createMainMenu();
                break;
            case 'addIncome':
                $portal->addIncome();
                break;
            case 'addExpense':
                $portal->addExpense();
                break;
            case 'bilans':
                $portal->bilans();
                break;
            case 'settings':
                $portal->settings();
                break;
            case 'logout':
                $portal->logout();
                break;
        }

        include 'templates/bigContainer.php';
    }

    include "html/footer.html";
}
catch(Exception $error)
{
  echo 'Błąd: ' . $error->getMessage();
  exit('Portal chwilowo niedostępny');
}

function classLoader($name)
{
  if( file_exists("classes/$name.php") )
        require_once("classes/$name.php");
  else
        throw new Exception("Brak pliku z definicją klasy");
}