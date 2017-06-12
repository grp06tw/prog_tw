<?php

class Application_Model_Catalog extends App_Model_Abstract {

    public function __construct() {
        $this->_logger = Zend_Registry::get('log');
    }

    //RICERCA

    public function search($values, $paged = null, $order = null) {
        if ($values['ID_Categoria'] == 'null' && $values['words'] == '') {
            return 0; //richiama pagina iniziale oppure nel public controller lo redirigi alla visual per categorie
        }
        if ($values['words'] == '') {
            return $this->getResource('Promozione')->getPromsByCat($values['ID_Categoria'], $paged, $order);
        }
        if ($values['ID_Categoria'] == 'null') {
            return $this->getResource('Promozione')->getPromsByWord($values['words'], $paged, $order);
        }

        return $this->getResource('Promozione')->fullSearch($values['words'], $values['ID_Categoria'], $paged, $order);
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
    
    public function getPromsByAz($azId, $paged = null, $order = null) {
        return $this->getResource('Promozione')->getPromsByAz($azId, $paged, $order);
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

    public function getUserByName($info) {
        return $this->getResource('Utente')->getUserLogin($info);
    }

//COUPON
    public function reach($iduser, $idpromo) {
        $q = $this->getResource('Coupon')->getCouponById($iduser, $idpromo);
        if ($q == 0) {
            $coupon["ID_Promozione"] = $idpromo;
            $coupon["ID_Utente"] = $iduser;
            $this->getResource('Coupon')->insertCoupon($coupon); //query inserimento nuovo coupon
            $risposta = $this->getResource('Coupon')->getCouponById($iduser, $idpromo); //query per prendere l'idCoupon inserito con l'autoincrement
            return $risposta; //ritorna il record completo del coupon
        } else {
            return 0;
            //qui dovrei mettere return il coupon che già è stato emesso per visualizzarlo
        }
    }

//PRENDI PROMO BY ID, UTENTE BY ID, AZIENDA PER ID PER STAMPARE IL FLAYER
    public function getUserById($id) {
        return $this->getResource('Utente')->getUserById($id);
    }

    public function getPromoById($id) {
        return $this->getResource('Promozione')->getPromoByID($id);
    }

    public function getAziendaById($id) {
        return $this->getResource('Azienda')->getAziendaByID($id);
    }

}
