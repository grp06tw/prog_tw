<?php

//**vedi commenti su categoria

class Application_Resource_Promozione extends Zend_Db_Table_Abstract {

    protected $_name = 'promozione';
    protected $_primary = 'ID_Promozione';
    protected $_rowClass = 'Application_Resource_Promozione_Item';

    public function init() {
        
    }

    //ORDER o PER CATEGORIA o PER AZIENDA
    // Estrae tutte le promozioni

    public function getProms($paged = null, $order = null) {
        
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

    // Estrae le promozioni della categoria $categoryId, eventualmente paginati ed ordinati
    public function getPromsByCat($categoryId, $paged = null, $order = null) {
        $select = $this->select()
                ->where("ID_Categoria = " . $categoryId);

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

    public function getPromsByWord($word, $paged = null, $order = null) {
        $words = explode(' ', $word);
        $sql = "descrizione LIKE '%" . $words[0] . "%'";
        for ($i = 1; $i < count($words); $i++) {
            $sql .= " OR descrizione LIKE '%" . $words[$i] . "%'";
        }
        $select = $this->select()
                ->where($sql);

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

    public function fullSearch($word, $id, $paged = null, $order = null) {
        $words = explode(' ', $word);
        $sql = "ID_Categoria = " . $id . " AND (descrizione LIKE '%" . $words[0] . "%'";
        for ($i = 1; $i < count($words); $i++) {
            $sql .= " OR descrizione LIKE '%" . $words[$i] . "%'";
        }
        $sql .= ")";
        $select = $this->select()
                ->where($sql);

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

    public function getPromoByID($id) {
        return $this->find($id)->current();
    }

    //INSERT

    public function insertPromo($promo) {
        if ($promo['immagine'] == null) {
            $promo['immagine'] = 'default.jpg';
        }
        $this->insert($promo);
    }

    //DELETE
    public function delPromo($promo)
    {
        $this->delete("ID_Promozione = ".$promo);

    }

    //UPDATE
    public function updatePromo($promo) {
        $this->update($promo, "ID_Promozione = " . $promo["ID_Promozione"]);
    }

}
