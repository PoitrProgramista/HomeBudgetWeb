<?php
class PortalBack
{
    private $loggedUser = null;

    function __construct()
    {

    }

    private function getDatabaseAccess()
    {
        $config = require 'config.php';

        try
        {
            $database = new PDO("mysql:host={$config['host']};dbname={$config['database']};charset=utf8", $config['user'], $config['password'], [PDO::ATTR_EMULATE_PREPARES => false, PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION]);
        }
        catch (PDOException $error)
        {
            exit('Database error');
        }

        return $database;
    }

    function queryDatabase($query, $arguments = array())
    {
        $database = $this->getDatabaseAccess();
        $result = $database->prepare($query);

        foreach($arguments as $argument => $argumentValue)
            $result->bindvalue($argument, $argumentValue, PDO::PARAM_STR);

        $result->execute();

        return $result;
    }

    function insertToDatabase($query, $arguments)
    {
        $database = $this->getDatabaseAccess();
        $result = $database->prepare($query);

        foreach($arguments as $argument => $argumentValue)
            $result->bindvalue($argument, $argumentValue, PDO::PARAM_STR);

        $result->execute();

        return $database->lastInsertId();;
    }

    function setLoggedUser($loggedUser)
    {
        $this->loggedUser = $loggedUser;
    }

    function getLoggedUser()
    {
        return $this->loggedUser;
    }
}
