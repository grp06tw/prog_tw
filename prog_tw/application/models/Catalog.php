<?php

class Application_Model_Catalog extends App_Model_Abstract {

    public function __construct() {
        $this->_logger = Zend_Registry::get('log');
    }

    //RICERCA
    
    public function search($values, $paged = null, $order = null){
        if($values['ID_Categoria']=='null' && $values['words']=='' ){
                return; //richiama pagina iniziale oppure nel public controller lo redirigi alla visual per categorie
        }
        if($values['words']=='' ){
                return $this->getResource('Promozione')->getPromsByCat($values['ID_Categoria'], $paged, $order);
        }
        if($values['ID_Categoria']=='null'){
                return $this->getResource('Promozione')->getPromsByWord($values['words'], $paged, $order);
        }
        
        return $this->getResource('Promozione')->fullSearch($values['words'],$values['ID_Categoria'], $paged, $order);
    }
    
    
    // CATEGORIE
    public function getCats() {
        return $this->getResource('Categoria')->getCats();
    }

    public function getCatById($id) {
        return $this->getResource('Categoria')->getCatById($id);
    }

    // PROMOZIONI

    public function getProms($paged = null, $order = null) {
        return $this->getResource('Promozione')->getProms($paged, $order);
    }

    public function getPromsByCat($catId, $paged = null, $order = null) {
        return $this->getResource('Promozione')->getPromsByCat($catId, $paged, $order);
    }

    // AZIENDE

    public function getAziende($paged = null, $order = null) {
        return $this->getResource('Azienda')->getAziende($paged, $order);
    }
    
    //FAQ

    public function getFaq($paged = null, $order = null) {
        return $this->getResource('Faq')->getFaq($paged, $order);
    }

// UTENTI
    //SALVA
    public function saveUser($user) {
        return $this->getResource('Utente')->insertUser($user);
    }
    
//COUPON
    public function reach($iduser, $idpromo) {
        $coupon[ID_Promozione] = $idpromo;
        $coupon[ID_Utente] = $iduser;
        return $this->getResource('Coupon')->insertCoupon($coupon);
    }
}
