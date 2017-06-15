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
        $risposta = $this->_catalogModel->reach($idUtente, $idPromo);
        if ($risposta['doppio'] == 1) {
            $doppio = "si";
            //messaggio di errore che quel coupon è già stato acquisito
        } else {
            $doppio = "no";
        }
        $utente = $this->_catalogModel->getUserById($idUtente);
        $promozione = $this->_catalogModel->getPromoById($idPromo);
        $azienda = $this->_catalogModel->getAziendaById($promozione["ID_Azienda"]);
        $categoria = $this->_catalogModel->getCatById($promozione["ID_Categoria"]);

        $this->_helper->layout->setLayout('user/_stampa');
        $this->view->assign(array('coupon',
            'promo' => $promozione,
            'utente' => $utente,
            'coupon' => $risposta['coupon'],
            'azienda' => $azienda,
            'categoria' => $categoria,
            'doppio' => $doppio));
        $this->render('coupon');
    }

    //****************************************
    //          MODIFICA DATI UTENTE
    //****************************************
    public function updatedataAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        
        $this->retrieveAction();
        $form = $this->_updateform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('operazione non riuscita');
            return $this->render('updatedata');
        }
        $campi = $form->getValues();
        $this->_userModel->updateUserData($campi);
        $this->_authService->authenticate($campi);
        $this->_helper->redirector('updatedata');
    }

    private function populateUpdateDataForm($records) {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_updateform = new Application_Form_User_Update();
        $this->_updateform->populate($records);
        $this->_updateform->setAction($urlHelper->url(array('controller' => 'user', 'action' => 'updatedata'), 'default'));
        return $this->_updateform;
    }

    public function retrieveAction() {
        $id = $this->_authService->getIdentity();

        $app = $this->_userModel->getUserData($id['Username']);
        $this->view->updatedataform = $this->populateUpdateDataForm($app->toArray());
    }

    //VALIDAZIONE AJAX

    public function validateuserAction() {
        $this->_helper->getHelper('layout')->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $form = new Application_Form_Admin_Utente_Add();
        $response = $form->processAjax($_POST);
        if ($response !== null) {
            $this->getResponse()->setHeader('Content-type', 'application/json')->setBody($response);
        }
    }

}
