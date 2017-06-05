<?php

class Application_Model_Admin extends App_Model_Abstract {

    public function __construct() {
        
    }

    //USERS
    public function getUsers($where = null) {
        return $this->getResource('Utente')->getUsers($where);
    }
    
    public function getUserById($id) {
        return $this->getResource('Utente')->getUsers($id);
    }

    public function getUserByName($info) {
        return $this->getResource('Utente')->getUserLogin($info);
    }

    //AZIENDA
    public function getAziende() {
        return $this->getResource('Azienda')->getAziende();
    }
    
     public function getAziendaById($id) {
        return $this->getResource('Azienda')->getAziendaById($id);
    }

    public function saveAzienda($values) {
        return $this->getResource('Azienda')->insertAzienda($values);
    }

    public function delAzienda($values) {
        return $this->getResource('Azienda')->deleteAzienda($values);
    }

    public function upAzienda($values) {
        return $this->getResource('Azienda')->updateAzienda($values);
    }

}
