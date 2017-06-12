<?php

class UserController extends Zend_Controller_Action {

    private $_authService;

    public function init() {
        $this->_helper->layout->setLayout('main');
        $this->view->assign(array('menu' => "user/_menu.phtml"));
        $this->view->assign(array('topbar' => "_topbar.phtml"));
        $this->_authService = new Application_Service_Auth();
        $this->_catalogModel = new Application_Model_Catalog();
    }

    public function indexAction() {
        
    }

    public function logoutAction() {
        $this->_authService->clear();
        return $this->_helper->redirector('index', 'public');
    }

    //****************************************
    //          OTTIENI COUPON
    //****************************************

    public function addcouponAction() {
        $idPromo = $this->_getParam('idPromo');
        $idUtente = $this->_getParam('idUtente');
        $risposta = $this->_catalogModel->reach($idUtente, $idPromo);
        if ($risposta == 0) {
            $this->_helper->redirector('promo', 'public');
            //messaggio di errore che quel coupon è già stato acquisito
        } else {
            $utente = $this->_catalogModel->getUserById($idUtente);
            $promozione = $this->_catalogModel->getPromoById($idPromo);
            
            $this->_helper->layout->setLayout('user/_stampa');
            
            //$this->view->assign(array('coupon' => "user/_stampa.phtml", 'promo'=>$promozione, 'utente'=>$utente, 'coupon'=>$coupon ));
            $this->view->assign(array('coupon', 'promo'=>$promozione, 'utente'=>$utente, 'coupon'=>$risposta ));
            
            $this->render('coupon');
            //$this->_helper->redirector('promo', 'public');
            //bisogna redirezionarlo sul file _stampa che è un nuovo layout
            //$this->_helper->layout->setLayout('main');
        }
    }

}
