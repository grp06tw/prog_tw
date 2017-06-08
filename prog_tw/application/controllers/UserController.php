<?php

class UserController extends Zend_Controller_Action
{	
    private $_authService;
    public function init()
    {
		$this->_helper->layout->setLayout('main');
                $this->view->assign(array('menu' => "user/_menu.phtml"));
                $this->view->assign(array('topbar' => "_topbar.phtml"));
		$this->_authService = new Application_Service_Auth();
                $this->_catalogModel = new Application_Model_Catalog();
    }

    public function indexAction()
    {}  

    public function logoutAction()
	{
		$this->_authService->clear();
		return $this->_helper->redirector('index','public');	
	}
        
    //****************************************
    //          OTTIENI COUPON
    //****************************************

    public function addcouponAction() {
        $idPromo = $this->_getParam('idPromo');
        $idUtente = $this->_getParam('idUtente');
        $this->_catalogModel->reach($idUtente, $idPromo);
        
        //bisogna redirezionarlo sul file _stampa che è un nuovo layout
        //$this->_helper->layout->setLayout('main');
        
        $this->_helper->redirector('index');
    }
    
}

