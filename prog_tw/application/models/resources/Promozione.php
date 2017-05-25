<?php

//**vedi commenti su categoria

class Application_Resource_Promozione extends Zend_Db_Table_Abstract
{
    protected $_name    = 'promozione';
    protected $_primary  = 'ID_Promozione';
    protected $_rowClass = 'Application_Resource_Promozione_Item';

	public function init()
    {
    }
    
   //ORDER o PER CATEGORIA o PER AZIENDA
    
    // Estrae tutte le promozioni
    public function getProms($paged=null, $order=null)
    {
		$select = $this->select();
                              
                    if (true === is_array($order)) {
                        $select->order($order);
                    }
                    
                if (null !== $paged) {
			$adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(2)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
		}
        return $this->fetchAll($select);
    }
    

	// Estrae le promozioni della categoria $categoryId, eventualmente paginati ed ordinati
    public function getPromsByCat($categoryId, $paged=null, $order=null)
    {
        $select = $this->select()
                        ->where('catId IN(?)', $categoryId);
        
        if (true === is_array($order)) {
            $select->order($order);
        }
		if (null !== $paged) {
			$adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
			$paginator = new Zend_Paginator($adapter);
			$paginator->setItemCountPerPage(1)
		          	  ->setCurrentPageNumber((int) $paged);
			return $paginator;
		}
        return $this->fetchAll($select);
    } 
    
    
    public function getPromoByID($id)
    {
        return $this->find($id)->current();
    } 

    
    //INSERT
    public function insertPromo($promo)
    {
    	$this->insert($promo);
    }
    
    //DELETE
    public function delPromo($promo)
    {
        $this->delete("ID_Promozione = ".$promo["ID_Promozione"]);
    }
    //UPDATE
    public function updatePromo($promo)
    {
	$this->update($promo, "ID_Promozione = ".$promo["ID_Promozione"]);
    }
}

