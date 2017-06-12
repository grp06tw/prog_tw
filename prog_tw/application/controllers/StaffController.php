<?php

class StaffController extends Zend_Controller_Action {

    protected $_staffModel;
    protected $_addform;

    private $_authService;

    public function init() {
        $this->_helper->layout->setLayout('main');
        $this->_staffModel = new Application_Model_Staff();
        $this->view->newpromoForm = $this->getAddPromoForm();
        $this->view->assign(array('menu' => "staff/_reservedmenu.phtml"));
        $this->view->assign(array('topbar' => "_topbar.phtml"));
        $this->view->assign(array('elimina' => $this->view->baseUrl('css/img/elimina.png')));
        $this->view->assign(array('modifica' => $this->view->baseUrl('css/img/modifica.png')));
        $this->_authService = new Application_Service_Auth();
    }

    public function indexAction() {
        
    }

    //****************************************
    //             ADD PROMO
    //****************************************  

    public function newpromoAction() {
        
    }

    public function addpromoAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_addform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('newpromo');
        }
        $values = $form->getValues();
        $this->_staffModel->savePromo($values);
        $this->_helper->redirector('index');
    }

    // Validazione AJAX
    public function validatepromoAction() {
        $this->_helper->getHelper('layout')->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $promoform = new Application_Form_Staff_Promo_Add();
        $response = $promoform->processAjax($_POST);
        if ($response !== null) {
            $this->getResponse()->setHeader('Content-type', 'application/json')->setBody($response);
        }
    }

    //****************************************
    //             MODIFICA PROMO
    //****************************************

    public function modpromoAction() {
        $righe = $this->_staffModel->getProms(null, array('titolo'));

        foreach ($righe as $riga) {
            $categorie[$riga["ID_Promozione"]] = $this->_staffModel->getCatById($riga["ID_Categoria"])->nome;
            $aziende[$riga["ID_Promozione"]] = $this->_staffModel->getAziendaById($riga["ID_Azienda"])->nome;
        }
        $this->view->assign(array('righe' => $righe,
            'categorie' => $categorie,
            'aziende' => $aziende
        ));
    }

    //****************************************
    //             UPDATE PROMO
    //****************************************

 
    public function updpromoAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index');
        }
        $form = $this->_addform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('operazione non riuscita');
            return $this->render('popolate');

        }
        $values = $form->getValues();
        //UPDATE
        $this->_staffModel->updatePromo($values);
        $this->_helper->redirector('modpromo');
    }
  
    public function popolateAction() {
        if ($id = $this->_getParam('ID')) {
            $app = $this->_staffModel->getPromoById($id);
            $this->view->updatepromoForm = $this->getUpdatePromoForm($app->toArray());
        }
    }

    //****************************************
    //             DELETE PROMO
    //****************************************

    public function deleteAction() {
        if ($id = $this->_getParam('ID')) {
            $this->_staffModel->delPromo($id);
            $this->_helper->redirector('modpromo');
        }
    }

    //****************************************
    //             GET FORMS
    //****************************************

    private function getAddPromoForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_addform = new Application_Form_Staff_Promo_Add();
        $this->_addform->setAction($urlHelper->url(array(
                    'controller' => 'staff',
                    'action' => 'addpromo'), 'default'
        ));
        return $this->_addform;
    }


  
    private function getUpdatePromoForm($values) {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_addform = new Application_Form_Staff_Promo_Add();
        $this->_addform->populate($values);
        $this->_addform->setAction($urlHelper->url(array(
                    'controller' => 'staff',
                    'action' => 'updpromo'), 'default'
        ));
        return $this->_addform;
    }


    //****************************************
    //             logout
    //****************************************

    public function logoutAction() {
        $this->_authService->clear();
        return $this->_helper->redirector('index', 'public');
    }

}
