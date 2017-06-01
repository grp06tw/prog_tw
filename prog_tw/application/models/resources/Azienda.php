<?php

class Application_Resource_Azienda extends Zend_Db_Table_Abstract {

    protected $_name = 'azienda'; //**nome preciso della tabella
    protected $_primary = 'ID_Azienda';    //**nome preciso chiave primaria
    protected $_rowClass = 'Application_Resource_Azienda_Item'; //**dove prende i record della tabella

    public function init() {
        
    }

    public function getAziende($paged = null, $order = null) {
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
    
    public function getAziendaById($id){
        return $this->find($id)->current();
    }

//insert
    public function insertAzienda($values) {
        if ($values['logo'] == null) {
            $values['logo'] = 'default.jpg';
        }
        $this->insert($values);
    }

//DELETE
    public function deleteAzienda($values) {
        $this->delete("ID_Azienda = " . $values["ID_Azienda"]);
    }

//UPDATE
    public function updateAzienda($values) {
        $this->update($values, "ID_Azienda = " . $values["ID_Azienda"]);
    }

}
