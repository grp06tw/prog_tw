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
    //CATEGORIA
    
    public function saveCat($values)
    {
    	return $this->getResource('Categoria')->insertCat($values);
    }
    
    public function getCats()
    {
	return $this->getResource('Categoria')->getCats();
    }
    
     public function getCatById($id)
    {
	return $this->getResource('Categoria')->getCatByID($id);
    }
    
    public function delCat($values) {
        return $this->getResource('Categoria')->delCat($values);
    }
    
    public function upCat($values) {
        return $this->getResource('Categoria')->upCat($values);
    }
    //-----FAQ-----//
    
    public function saveFaq($faq)
    {
    	return $this->getResource('Faq')->insertFaq($faq);
    }
    
    public function getFaq()
    {
	return $this->getResource('Faq')->getFaq();
    }
    
     public function getFaqById($id)
    {
	return $this->getResource('Faq')->getFaqByID($id);
    }
    
    public function delFaq($values) {
        return $this->getResource('Faq')->deleteFaq($values);
    }
    
    public function upFaq($values) {
        return $this->getResource('Faq')->upFaq($values);
    }
    
    //COUPON
    public function getCoupon() {
        return $this->getResource('Coupon')->getCoupon();
    }

    //PROMOZIONI
    public function getProms() {
        return $this->getResource('Promozione')->getProms();
    }
}
