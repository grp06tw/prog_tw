<?php

class Application_Resource_Azienda extends Zend_Db_Table_Abstract
{
    protected $_name    = 'azienda'; //**nome preciso della tabella
    protected $_primary  = 'ID_Azienda';    //**nome preciso chiave primaria
    protected $_rowClass = 'Application_Resource_Azienda_Item'; //**dove prende i record della tabella
    
	public function init()
    {
    }
      public function getAziende($paged=null, $order=null)
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
}

