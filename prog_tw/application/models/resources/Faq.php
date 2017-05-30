<?php

class Application_Resource_Faq extends Zend_Db_Table_Abstract
{
    protected $_name    = 'faq'; 
    protected $_primary  = 'ID_Faq';    
    protected $_rowClass = 'Application_Resource_Faq_Item'; 
    
	public function init()
    {
    }
    
    public function getFaq($paged = null, $order = null) {
        $select = $this->select();

        if (true === is_array($order)) {
            $select->order($order);
        }

        if (null !== $paged) {
            $adapter = new Zend_Paginator_Adapter_DbTableSelect($select);
            $paginator = new Zend_Paginator($adapter);
            $paginator->setItemCountPerPage(5)
                    ->setCurrentPageNumber((int) $paged);
            return $paginator;
        }
        return $this->fetchAll($select);
    }
      
}

