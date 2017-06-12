<?php

class UserController extends Zend_Controller_Action {

    private $_authService;
    protected $_userModel;
    protected $_updateform;
    public function init() {
        $this->_helper->layout->setLayout('main');
        $this->view->assign(array('menu' => "user/_menu.phtml"));
        $this->view->assign(array('topbar' => "_topbar.phtml"));
        $this->_authService = new Application_Service_Auth();
        $this->_catalogModel = new Application_Model_Catalog();
        $this->_userModel = new Application_Model_User();
        $this->view->updatedataform = $this->retrieveAction();
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
    //****************************************
    //          MODIFICA DATI UTENTE
    //****************************************
    public function updatedataAction(){
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_updateform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('operazione non riuscita');
            return $this->render('updatedata');
        }
        $campi = $form->getValues();
        $this->_userModel->updateUserData($campi);
        $this->_helper->redirector('updatedata');
    }
    
    private function populateUpdateDataForm($records){
        $urlHelper = $this->_helper->getHelper('url');
        $this->_updateform = new Application_Form_User_Update();
        $this->_updateform->populate($records);
        $this->_updateform->setAction($urlHelper->url(array('controller'=> 'user', 'action'=> 'updatedata'),'default'));
        return $this->_updateform;
    }

    public function retrieveAction(){
        $id = $this->_authService->getIdentity();
        
        $app = $this->_userModel->getUserData($id['Username']);
        $this->view->updatedataform = $this->populateUpdateDataForm($app->toArray());
    }
}
