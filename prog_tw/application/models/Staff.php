<?php

class Application_Model_Staff extends App_Model_Abstract
{ 

	public function __construct()
    {
    }

    public function getCats()
    {
		return $this->getResource('Categoria')->getCats();
    }
    
    public function savePromo($promo)
    {
    	return $this->getResource('Promozione')->insertPromo($promo);
    }
    
    
    
    
    public function getAziende()
    {
		return $this->getResource('Azienda')->getAziende();
    }
}