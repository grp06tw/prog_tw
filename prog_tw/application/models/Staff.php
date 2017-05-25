<?php

class Application_Model_Staff extends App_Model_Abstract
{ 

	public function __construct()
    {
    }
    
    
//CATEGORIE
    public function getCats()
    {
		return $this->getResource('Categoria')->getCats();
    }
    
    
//PROMOZIONI
    //SALVA
    public function savePromo($promo)
    {
    	return $this->getResource('Promozione')->insertPromo($promo);
    }
    //GET
    public function getProms()
    {
		return $this->getResource('Promozione')->getProms();
    }
     public function getPromoById($id)
    {
		return $this->getResource('Promozione')->getPromoByID($id);
    }
    //DELETE
    public function delPromo($promo)
    {
		return $this->getResource('Promozione')->delPromo($promo);
    }
    //UPDATE
    public function updatePromo($promo)
    {
		return $this->getResource('Promozione')->updatePromo($promo);
    }
    
//AZIENDE    
    public function getAziende()
    {
		return $this->getResource('Azienda')->getAziende();
    }
}