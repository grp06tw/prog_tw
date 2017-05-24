<?php

class Application_Resource_Faq extends Zend_Db_Table_Abstract
{
    protected $_name    = 'faq'; 
    protected $_primary  = 'ID_Faq';    
    protected $_rowClass = 'Application_Resource_Faq_Item'; 
    
	public function init()
    {
    }
      
}

