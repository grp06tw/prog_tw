<?php
class Application_Model_User extends App_Model_Abstract{

    public function __construct() {
        
    }
    //DATI PER MODIFICA PROFILO
    public function getUserData($rec){
        return $this->getResource('Utente')->getUserDataByUsername($rec);
    }
    //UPDATE DATI PER MODIFICA PROFILO
    public function updateUserData($campi){
        return $this->getResource('Utente')->upUser($campi);
    }
}