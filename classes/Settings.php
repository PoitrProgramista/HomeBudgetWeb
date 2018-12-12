<?php
class Settings
{
    private $userID;
    private $portalBack = null;
    private $settingsForm = null;
    private $parameterUserID =':userID';
    private $parameterCategoryID =':categoryID';

    public function __construct($portalBack, $settingsForm)
    {
        $this->portalBack = $portalBack;
        $this->settingsForm = $settingsForm;
    }

    public function submit()
    {

    }
}