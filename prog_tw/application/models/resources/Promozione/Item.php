<?php

class Application_Resource_Promozione_Item extends Zend_Db_Table_Row_Abstract
{   
    
    
    //calcola il prezzo scontato
	public function getPrice()
    {
    	$prezzo = $this->prezzo;
    	
            $discount = $this->sconto;
            $discounted = ($prezzo*$discount)/100;
            $prezzo = round($prezzo - $discounted, 2);

        return $prezzo;
    }
    
}