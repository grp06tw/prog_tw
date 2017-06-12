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
        if ($this->_catalogModel->reach($idUtente, $idPromo)) {
            $this->_helper->redirector('promo');
            //bisogna redirezionarlo sul file _stampa che è un nuovo layout
            //$this->_helper->layout->setLayout('main');
        } else {

            $this->_helper->redirector('index');
            //messaggio di errore che quel coupon è già stato acquisito
        }
    }

}
