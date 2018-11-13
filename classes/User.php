<?php
class User
{
    public $id;
    public $name;

    public function __construct($id, $name)
    {
        $this->id = $id;
        $this->name = $name;
    }

    function getName()
    {
        return $this->name;
    }

    function getID()
    {
        return $this->id; 
    }
}
