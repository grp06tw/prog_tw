<?php

class Application_Resource_Utente extends Zend_Db_Table_Abstract
{
    protected $_name    = 'utente'; 
    protected $_primary  = 'ID_Utente';    
    protected $_rowClass = 'Application_Resource_Utente_Item'; 
    
	public function init()
    {
    }
      
    public function getUserLogin($usrName)
    {
        return $this->fetchRow($this->select()->where('Username = ?', $usrName));
        //select -> where id_utente
    }	
    
    //
}

