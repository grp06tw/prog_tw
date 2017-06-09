<?php

class Application_Resource_Categoria extends Zend_Db_Table_Abstract {

    protected $_name = 'categoria'; //**nome preciso della tabella
    protected $_primary = 'ID_Categoria';    //**nome preciso chiave primaria
    protected $_rowClass = 'Application_Resource_Categoria_Item'; //**dove prende i record della tabella

    //**cancellare e rifare qui le query che servono per le categorie

    public function init() {
        
    }

    // Estrae i dati della categoria $id
    public function getCatById($id) {
        return $this->find($id)->current();
    }

    // Estrae tutte le categorie
    public function getCats() {
        $select = $this->select()
                ->order('nome');
        return $this->fetchAll($select);
    }

    //qui andremo ad inserire le cìselect che ci serviranno per il crud delle categorie
    public function insertCat($values) {
        $cats = $this->getCats();
        $ok = 1;
        foreach ($cats as $cat) {
            if ($cat["nome"] == $values["nome"]){
                
            $ok = null;
            }
        }
        if ($ok) {
            $this->insert($values);
        }
    }

    public function delCat($values) {
        $this->delete("ID_Categoria = " . $values);
    }

    public function upCat($values) {
        $this->update($values, "ID_Categoria = " . $values["ID_Categoria"]);
    }

}
