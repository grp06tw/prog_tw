<?php

class Application_Resource_Combo extends Zend_Db_Table_Abstract
{
    protected $_name    = 'combo'; 
    protected $_primary  = 'ID_Combo';    
    protected $_rowClass = 'Application_Resource_Combo_Item'; 
    
	public function init()
    {
    }
      
}

