<?php

class Application_Resource_Azienda extends Zend_Db_Table_Abstract
{
    protected $_name    = 'azienda'; //**nome preciso della tabella
    protected $_primary  = 'ID_Azienda';    //**nome preciso chiave primaria
    protected $_rowClass = 'Application_Resource_Azienda_Item'; //**dove prende i record della tabella
    
	public function init()
    {
    }
      public function getAziende()
    {
		$select = $this->select()
                               ->order('nome');
        return $this->fetchAll($select);
    }
}

