<?php

class Application_Model_Catalog extends App_Model_Abstract {

    public function __construct() {
        $this->_logger = Zend_Registry::get('log');
    }

    //RICERCA
    
    public function search($values){
        if($values['ID_Categoria']=='null' && $values['words']=='' ){
                return;
        }
        if($values['words']=='' ){
                return $this->getResource('Promozione')->getPromsByCat($values['ID_Categoria']);
        }
        if($values['ID_Categoria']=='null'){
                return $this->getResource('Promozione')->getPromsByWord($values['words']);
        }
        
        return $this->getResource('Promozione')->fullSearch($values['words'],$values['ID_Categoria']);
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

    public function getFaq($paged = null, $order = null) {
        return $this->getResource('Faq')->getFaq($paged, $order);
    }

// UTENTI
    //SALVA
    public function saveUser($user) {
        return $this->getResource('Utente')->insertUser($user);
    }

    /* GET
      public function getProms()
      {
      return $this->getResource('Promozione')->getProms();
      }
      public function getPromoById($id)
      {
      return $this->getResource('Promozione')->getPromoByID($id);
      }
      //DELETE
      public function delPromo($promo)
      {
      return $this->getResource('Promozione')->delPromo($promo);
      }
      //UPDATE
      public function updatePromo($promo)
      {
      return $this->getResource('Promozione')->updatePromo($promo);
      } */
}
