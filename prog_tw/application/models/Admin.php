<?php

class Application_Model_Admin extends App_Model_Abstract
{ 

	public function __construct()
    {
    }
    
    public function getUserByName($info)
    {
    	return $this->getResource('Utente')->getUserLogin($info);
    }

}