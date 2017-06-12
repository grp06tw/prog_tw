<?php

class Application_Resource_Faq extends Zend_Db_Table_Abstract {

    protected $_name = 'faq';
    protected $_primary = 'ID_Faq';
    protected $_rowClass = 'Application_Resource_Faq_Item';

    public function init() {
        
    }

    //-----GET-----//

    public function getFaq() {
        $select = $this->select();

        
        return $this->fetchAll($select);
    }
    
    public function getFaqById($id) {
        return $this->find($id)->current();
    }

    //-----INSERT-----//
    public function insertFaq($faq) {
        $this->insert($faq);
    }

    //-----DELETE-----//
    public function deleteFaq($values) {
        $this->delete("ID_Faq = " . $values["ID_Faq"]);
    }
//update
public function upFaq($values){
        $this->update($values, "ID_Faq = " . $values["ID_Faq"]);
   
}
}
