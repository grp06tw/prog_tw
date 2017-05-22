<?php

class Application_Resource_Coupon extends Zend_Db_Table_Abstract
{
    protected $_name    = 'coupon'; 
    protected $_primary  = 'ID_Coupon';    
    protected $_rowClass = 'Application_Resource_Coupon_Item'; 
    
	public function init()
    {
    }
      
}

