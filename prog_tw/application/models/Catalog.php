<?php

class Application_Model_Catalog extends App_Model_Abstract
{ 

	public function __construct()
        {
		$this->_logger = Zend_Registry::get('log');  	
	}

        
   // CATEGORIE
    public function getCats()
    {
		return $this->getResource('Categoria')->getCats();
    }
    public function getCatById($id)
    {
        return $this->getResource('Categoria')->getCatById($id);
    }

    
     // PROMOZIONI
    
    public function getProms($paged=null, $order=null)
    {       
        return $this->getResource('Promozione')->getProms($paged, $order);
    }
    
    public function getPromsByCat($catId, $paged=null, $order=null)
    {       
        return $this->getResource('Promozione')->getPromsByCat($catId, $paged, $order);
    }
	
    // AZIENDE
    
    public function getAziende($paged=null, $order=null)
    {       
        return $this->getResource('Azienda')->getAziende($paged, $order);
    }
}