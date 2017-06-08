<?php

class AdminController extends Zend_Controller_Action {

    protected $_adminModel;
    protected $_authService;
    protected $_newAzform;
    protected $_delAzform;
    protected $_selAzform;

    public function init() {
        $this->_helper->layout->setLayout('main');
        $this->view->assign(array('menu' => "admin/_reservedmenu.phtml"));
        $this->view->assign(array('topbar' => "_topbar.phtml"));
        $this->_adminModel = new Application_Model_Admin();
        $this->_authService = new Application_Service_Auth();

        $this->view->newaziendaform = $this->getAddAziendaForm();
        $this->view->delaziendaform = $this->getDelAziendaForm();
        $this->view->selaziendaform = $this->getSelAziendaForm();
    }

    public function indexAction() {
        $this->view->assign(array('title' => "Area Admin"));
    }

    //****************************************
    //                AZIENDE
    //****************************************
    public function aziendeAction() {
        $this->view->assign(array('menu' => "admin/aziende/_crudaziende.phtml"));
        $this->view->assign(array('title' => "Gestisci Aziende"));
        $this->render('index');
    }

    //************NEW*************
    public function newaziendaAction() {
        $this->view->assign(array('menu' => "admin/aziende/_crudaziende.phtml"));
        $this->view->newaziendaform = $this->getAddAziendaForm();
    }

    public function addaziendaAction() {
        $this->view->assign(array('menu' => "admin/aziende/_crudaziende.phtml"));
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('newazienda');
        }
        $form = $this->_newAzform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('newazienda');
        }
        $values = $form->getValues();
        $this->_adminModel->saveAzienda($values);
        $this->_helper->redirector('newazienda');
    }
    
    // Validazione AJAX
    /*public function validatenewazAction() {
        $this->_helper->getHelper('layout')->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $aziendaform = new Application_Form_Admin_Azienda_Add();
        $response = $aziendaform->processAjax($_POST);
        if ($response !== null) {
            $this->getResponse()->setHeader('Content-type', 'application/json')->setBody($response);
        }
    }*/

    //************DELETE*************
    public function deleteaziendaAction() {
        $this->view->assign(array('menu' => "admin/aziende/_crudaziende.phtml"));
    }

    public function delaziendaAction() {
        $this->view->assign(array('menu' => "admin/aziende/_crudaziende.phtml"));
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('deleteazienda');
        }
        $form = $this->_delAzform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('operazione non riuscita');
            return $this->render('deleteazienda');
        }
        $values = $form->getValues();
        $this->_adminModel->delAzienda($values);
        $this->_helper->redirector('deleteazienda');
    }

    //************UPDATE*************
    public function updateaziendaAction() {
        $this->view->assign(array('menu' => "admin/aziende/_crudaziende.phtml"));
    }

    public function updaziendaAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('updateazienda');
        }
        $form = $this->_newAzform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('operazione non riuscita');
            return $this->render('updateazienda');
        }
        $values = $form->getValues();
        //UPDATE
        $this->_adminModel->upAzienda($values);
        $this->_helper->redirector('updateazienda');
    }

    public function popolateaziendaAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('updateazienda');
        }
        $form = $this->_selAzform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('operazione non riuscita');
            return $this->render('updateazienda');
        }
        $values = $form->getValues();
        $app = $this->_adminModel->getAziendaById($values);
        $prova = $app["ID_Azienda"];
        $this->view->updateaziendaform = $this->getUpdateAziendaForm($app->toArray());
    }

    //************GET*************
    private function getAddAziendaForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_newAzform = new Application_Form_Admin_Azienda_Add();
        $this->_newAzform->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'addazienda'), 'default'
        ));
        return $this->_newAzform;
    }

    private function getDelAziendaForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_delAzform = new Application_Form_Admin_Azienda_Delete();
        $this->_delAzform->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'delazienda'), 'default'
        ));
        return $this->_delAzform;
    }

    private function getSelAziendaForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_selAzform = new Application_Form_Admin_Azienda_Select();
        $this->_selAzform->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'popolateazienda'), 'default'
        ));
        return $this->_selAzform;
    }

    private function getUpdateAziendaForm($values) {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_newAzform = new Application_Form_Admin_Azienda_Add();
        $this->_newAzform->populate($values);
        $this->_newAzform->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'updazienda'), 'default'
        ));
        return $this->_newAzform;
    }

    //****************************************
    //                CATEGORIE
    //****************************************
    public function categorieAction() {
        $this->view->assign(array('menu' => "admin/categorie/_crudcategorie.phtml"));
        $this->view->assign(array('title' => "Gestisci Categorie"));
        $this->render('index');
    }

    //****************************************
    //                UTENTI
    //****************************************
    public function utentiAction() {
        $this->view->assign(array('menu' => "admin/utenti/_crudutenti.phtml"));
        $this->view->assign(array('title' => "Gestisci Utenti"));
        $this->render('index');
    }

    //****************************************
    //                FAQ
    //****************************************
    public function faqAction() {
        $this->view->assign(array('menu' => "admin/faq/_crudfaq.phtml"));
        $this->view->assign(array('title' => "Gestisci FAQ"));
        $this->render('index');
    }

    //****************************************
    //                STATISTICHE
    //****************************************

    public function statsAction() {
        
        
    }

    //****************************************
    //                LOGOUT
    //****************************************
    public function logoutAction() {
        $this->_authService->clear();
        return $this->_helper->redirector('index', 'public');
    }

}
