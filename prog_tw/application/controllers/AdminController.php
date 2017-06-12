<?php

class AdminController extends Zend_Controller_Action {

    protected $_adminModel;
    protected $_authService;
    protected $_newAzform;
    protected $_newFaqform;
    protected $_newCatForm;
    protected $_newUsrForm;
    protected $_updateform;
    
    public function init() {
        $this->_helper->layout->setLayout('main');
        $this->view->assign(array('menu' => "admin/_reservedmenu.phtml"));
        $this->view->assign(array('topbar' => "_topbar.phtml"));
        $this->_adminModel = new Application_Model_Admin();
        $this->_authService = new Application_Service_Auth();

        $this->view->assign(array('elimina' => $this->view->baseUrl('css/img/elimina.png')));
        $this->view->assign(array('modifica' => $this->view->baseUrl('css/img/modifica.png')));
        $this->view->newaziendaform = $this->getAddAziendaForm();
        $this->view->newfaqform = $this->getAddFaqForm();
        $this->view->newcatform = $this->getAddCatForm();
        $this->view->newusrform = $this->getAddUsrForm();
        $this->view->updatedataform = $this->retrieveAction();
    }

    public function indexAction() {
        $this->view->assign(array('title' => "Area Admin"));
    }

    //************************************************************************************************************
    //                AZIENDE
    //************************************************************************************************************



    public function aziendeAction() {
        $this->view->assign(array('menu' => "admin/aziende/_crudaziende.phtml"));
        $this->view->assign(array('title' => "Gestisci Aziende"));
        $this->render('index');
    }

    //****************************************
    //             NEW AZIENDA
    //****************************************  
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

    //****************************************
    //             MODIFICA AZIENDA
    //****************************************

    public function modaziendaAction() {
        $this->view->assign(array('menu' => "admin/aziende/_crudaziende.phtml"));

        $righe = $this->_adminModel->getAziende(null, array('titolo'));
        $this->view->assign(array('righe' => $righe));
        foreach ($righe as $riga) {
            if ($riga["ID_Utente"] != null) {
                $utenti[$riga["ID_Azienda"]] = $this->_adminModel->getUserById($riga["ID_Utente"])->Username;
            }
        }
        if (isset($utenti)) {
            $this->view->assign(array('utenti' => $utenti));
        }
    }

    //****************************************
    //             UPDATE AZIENDA
    //****************************************

    public function updaziendaAction() {
        $this->view->assign(array('menu' => "admin/aziende/_crudaziende.phtml"));

        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('modazienda');
        }
        $form = $this->_newAzform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('operazione non riuscita');
            $this->view->updateaziendaform = $this->_newAzform;
            return $this->render('popolateaz');
        }
        $values = $form->getValues();
        //UPDATE
        $this->_adminModel->upAzienda($values);
        $this->_helper->redirector('modazienda');
    }

    public function popolateazAction() {
        $this->view->assign(array('menu' => "admin/aziende/_crudaziende.phtml"));
        if ($id = $this->_getParam('ID')) {
            $app = $this->_adminModel->getAziendaById($id);
            $this->view->updateaziendaform = $this->getUpdateAziendaForm($app->toArray());
        }
    }

    //****************************************
    //             DELETE AZIENDA
    //****************************************

    public function deleteazAction() {
        if ($id = $this->_getParam('ID')) {
            $this->_adminModel->delAzienda($id);
            $this->_helper->redirector('modazienda');
        }
    }

    //****************************************
    //             GET FORMS AZIENDA
    //****************************************  

    private function getAddAziendaForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_newAzform = new Application_Form_Admin_Azienda_Add();
        $this->_newAzform->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'addazienda'), 'default'
        ));
        return $this->_newAzform;
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

    //**********************************************************************************************************
    //                CATEGORIE
    //**********************************************************************************************************





    public function categorieAction() {
        $this->view->assign(array('menu' => "admin/categorie/_crudcategorie.phtml"));
        $this->view->assign(array('title' => "Gestisci Categorie"));
        $this->render('index');
    }

    //****************************************
    //              NEW  CATEGORIA
    //****************************************
    public function newcategoriaAction() {
        $this->view->assign(array('menu' => "admin/categorie/_crudcategorie.phtml"));
        $this->view->newcatform = $this->getAddCatForm();
    }

    public function addcatAction() {
        $this->view->assign(array('menu' => "admin/categorie/_crudcategorie.phtml"));

        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('newcategoria');
        }
        $form = $this->_newCatForm;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('newcategoria');
        }
        $values = $form->getValues();
        $this->_adminModel->saveCat($values);
        $this->_helper->redirector('categorie');
    }

    //****************************************
    //              MODIFICA  CATEGORIA
    //****************************************

    public function modcategoriaAction() {
        $this->view->assign(array('menu' => "admin/categorie/_crudcategorie.phtml"));

        $righe = $this->_adminModel->getCats();
        $this->view->assign(array('righe' => $righe));
    }

    //****************************************
    //             UPDATE CATEGORIE
    //****************************************

    public function updcatAction() {
        $this->view->assign(array('menu' => "admin/categorie/_crudcategorie.phtml"));

        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('modcategoria');
        }
        $form = $this->_newCatForm;
        if (!$form->isValid($_POST)) {
            $form->setDescription('operazione non riuscita');
            $this->view->updatecatform = $this->_newCatForm;
            return $this->render('popolatecat');
        }
        $values = $form->getValues();
        //UPDATE
        $this->_adminModel->upCat($values);
        $this->_helper->redirector('modcategoria');
    }

    public function popolatecatAction() {
        $this->view->assign(array('menu' => "admin/categorie/_crudcategorie.phtml"));
        if ($id = $this->_getParam('ID')) {
            $app = $this->_adminModel->getCatById($id);
            $this->view->updatecatform = $this->getUpdateCatForm($app->toArray());
        }
    }

    //****************************************
    //             DELETE CATEGORIE
    //****************************************
    public function deletecatAction() {
        if ($id = $this->_getParam('ID')) {
            $this->_adminModel->delCat($id);
            $this->_helper->redirector('modcategoria');
        }
    }

    //****************************************
    //             GET FORMS CAT
    //****************************************  

    private function getAddCatForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_newCatForm = new Application_Form_Admin_Categoria_Add();
        $this->_newCatForm->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'addcat'), 'default'
        ));
        return $this->_newCatForm;
    }

    private function getUpdateCatForm($values) {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_newCatForm = new Application_Form_Admin_Categoria_Add();
        $this->_newCatForm->populate($values);
        $this->_newCatForm->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'updcat'), 'default'
        ));
        return $this->_newCatForm;
    }

    //*************************************************************************************
    //                UTENTI
    //*************************************************************************************



    public function utentiAction() {
        $this->view->assign(array('menu' => "admin/utenti/_crudutenti.phtml"));
        $this->view->assign(array('title' => "Gestisci Utenti"));
        $this->render('index');
    }

    //****************************************
    //              NEW  UTENTE
    //****************************************
    public function newutenteAction() {
        $this->view->assign(array('menu' => "admin/utenti/_crudutenti.phtml"));
        $this->view->newusrform = $this->getAddUsrForm();
    }

    public function addusrAction() {
        $this->view->assign(array('menu' => "admin/utenti/_crudutenti.phtml"));
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('newutente');
        }
        $form = $this->_newUsrForm;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('newutente');
        }       
        $values = $form->getValues();
        if($this->_adminModel->getUserByName($values["Username"])){
            $form->setDescription('Attenzione: Username gia in uso');
            return $this->render('newutente');
        }
         
        $this->_adminModel->saveUser($values);
        $this->_helper->redirector('utenti');
    }

    //****************************************
    //              MODIFICA  UTENTE
    //****************************************

    public function modutenteAction() {
        $this->view->assign(array('menu' => "admin/utenti/_crudutenti.phtml"));

        $righe = $this->_adminModel->getUsers(null,"role");
        $this->view->assign(array('righe' => $righe));
    }

    //****************************************
    //             UPDATE UTENTI
    //****************************************

    public function updusrAction() {
        $this->view->assign(array('menu' => "admin/utenti/_crudutenti.phtml"));

        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('modutente');
        }
        $form = $this->_newUsrForm;
        if (!$form->isValid($_POST)) {
            $form->setDescription('operazione non riuscita');
            $this->view->updateusrform = $this->_newUsrForm;
            return $this->render('popolateusr');
        }
        $values = $form->getValues();
        //UPDATE
        $this->_adminModel->upUser($values);
        $this->_helper->redirector('modutente');
    }

    public function popolateusrAction() {
        $this->view->assign(array('menu' => "admin/utenti/_crudutenti.phtml"));
        if ($id = $this->_getParam('ID')) {
            $app = $this->_adminModel->getUserById($id);
            $this->view->updateusrform = $this->getUpdateUsrForm($app->toArray());
        }
    }

    //****************************************
    //             DELETE UTENTE
    //****************************************
    public function deleteusrAction() {
        if ($id = $this->_getParam('ID')) {
            $this->_adminModel->deleteUser($id);
            $this->_helper->redirector('modutente');
        }
    }

    //****************************************
    //             GET FORMS UTENTE
    //****************************************  

    private function getAddUsrForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_newUsrForm = new Application_Form_Admin_Utente_Add();
        $this->_newUsrForm->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'addusr'), 'default'
        ));
        return $this->_newUsrForm;
    }

    private function getUpdateUsrForm($values) {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_newUsrForm = new Application_Form_Admin_Utente_Add();
        $this->_newUsrForm->populate($values);
        $this->_newUsrForm->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'updusr'), 'default'
        ));
        return $this->_newUsrForm;
    }

    //************************************************************************************************************
    //                FAQ
    //************************************************************************************************************



    public function faqAction() {
        $this->view->assign(array('menu' => "admin/faq/_crudfaq.phtml"));
        $this->view->assign(array('title' => "Gestisci FAQ"));
        $this->render('index');
    }

    //****************************************
    //              NEW  FAQ
    //****************************************
    public function newfaqAction() {
        $this->view->assign(array('menu' => "admin/faq/_crudfaq.phtml"));
        $this->view->newfaqform = $this->getAddFaqForm();
    }

    public function addfaqAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('newfaq');
        }
        $form = $this->_newFaqform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('newfaq');
        }
        $values = $form->getValues();
        $this->_adminModel->saveFaq($values);
        $this->_helper->redirector('faq');
    }

//    //-----VALIDAZIONE AJAX-----//
//    public function validatefaqAction() {
//        $this->_helper->getHelper('layout')->disableLayout();
//        $this->_helper->viewRenderer->setNoRender();
//
//        $promoform = new Application_Form_Admin_Faq_Add();
//        $response = $faqform->processAjax($_POST);
//        if ($response !== null) {
//            $this->getResponse()->setHeader('Content-type', 'application/json')->setBody($response);
//        }
//    }
    //****************************************
    //              MODIFICA  FAQ
    //****************************************

    public function modfaqAction() {
        $this->view->assign(array('menu' => "admin/faq/_crudfaq.phtml"));

        $righe = $this->_adminModel->getFaq();
        $this->view->assign(array('righe' => $righe));
    }

    //****************************************
    //             UPDATE FAQ
    //****************************************

    public function updfaqAction() {
        $this->view->assign(array('menu' => "admin/aziende/_crudfaq.phtml"));

        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('modfaq');
        }
        $form = $this->_newFaqform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('operazione non riuscita');
            $this->view->updatefaqform = $this->_newFaqform;
            return $this->render('popolatefaq');
        }
        $values = $form->getValues();
        //UPDATE
        $this->_adminModel->upFaq($values);
        $this->_helper->redirector('modfaq');
    }

    public function popolatefaqAction() {
        $this->view->assign(array('menu' => "admin/faq/_crudfaq.phtml"));
        if ($id = $this->_getParam('ID')) {
            $app = $this->_adminModel->getFaqById($id);
            $this->view->updatefaqform = $this->getUpdateFaqForm($app->toArray());
        }
    }

    //****************************************
    //             DELETE FAQ
    //****************************************
    public function deletefaqAction() {
        if ($id = $this->_getParam('ID')) {
            $this->_adminModel->delFaq($id);
            $this->_helper->redirector('modfaq');
        }
    }

    //****************************************
    //             GET FORMS FAQ
    //****************************************  

    private function getAddFaqForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_newFaqform = new Application_Form_Admin_Faq_Add();
        $this->_newFaqform->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'addfaq'), 'default'
        ));
        return $this->_newFaqform;
    }

    private function getUpdateFaqForm($values) {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_newFaqform = new Application_Form_Admin_Faq_Add();
        $this->_newFaqform->populate($values);
        $this->_newFaqform->setAction($urlHelper->url(array(
                    'controller' => 'admin',
                    'action' => 'updfaq'), 'default'
        ));
        return $this->_newFaqform;
    }

    //************************************************************************************************************
    //                STATISTICHE
    //************************************************************************************************************

    public function statsAction() {
        $coupon = $this->_adminModel->getCoupon();
        $this->view->assign(array('nCoupon' => count($coupon)));
        $utenti = $this->_adminModel->getUsers("user",null);
        $promozioni = $this->_adminModel->getProms();
        $count = 0;
        foreach ($promozioni as $promo) {
            for ($i = 0; $i < count($coupon); $i++) {
                if ($coupon[$i]["ID_Promozione"] == $promo["ID_Promozione"]) {
                    $count++;
                }
            }
            $stP[$promo["ID_Promozione"]] = array("Promozione" => $promo["titolo"], "couponEmessi" => $count);
        }
        $count = 0;
        foreach ($utenti as $utente) {
            for ($i = 0; $i < count($coupon); $i++) {
                if ($coupon[$i]["ID_Utente"] == $utente["ID_Utente"]) {
                    $count++;
                }
            }
            $stU[$utente["ID_Utente"]] = array("Username" => $utente["Username"], "couponAcquistati" => $count);
        }


        $righe = $this->_adminModel->getAziende(null, array('titolo'));
        $this->view->assign(array('p' => $stP, 'u' => $stU));
        if ($param = $this->_getParam('param')){
                    $this->view->assign(array('by' => $param));
        }
    }

    //************************************************************************************************************
    //                LOGOUT
    //************************************************************************************************************
    public function logoutAction() {
        $this->_authService->clear();
        return $this->_helper->redirector('index', 'public');
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
        $this->_adminModel->updateUserData($campi);
        $this->_helper->redirector('updatedata');
    }
    
    private function populateUpdateDataForm($records){
        $urlHelper = $this->_helper->getHelper('url');
        $this->_updateform = new Application_Form_User_Update();
        $this->_updateform->populate($records);
        $this->_updateform->setAction($urlHelper->url(array('controller'=> 'admin', 'action'=> 'updatedata'),'default'));
        return $this->_updateform;
    }

    public function retrieveAction(){
        $id = $this->_authService->getIdentity();
            $app = $this->_adminModel->getUserData($id['Username']);
            $this->view->updatedataform = $this->populateUpdateDataForm($app->toArray());
    }
    
    //****************************************
    //          VALIDAZIONI AJAX
    //****************************************
    public function validateazAction() {
        $this->_helper->getHelper('layout')->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $form = new Application_Form_Admin_Azienda_Add();
        $response = $form->processAjax($_POST);
        if ($response !== null) {
            $this->getResponse()->setHeader('Content-type', 'application/json')->setBody($response);
        }
    }
    
    public function validatecatAction() {
        $this->_helper->getHelper('layout')->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $form = new Application_Form_Admin_Categoria_Add();
        $response = $form->processAjax($_POST);
        if ($response !== null) {
            $this->getResponse()->setHeader('Content-type', 'application/json')->setBody($response);
        }
    }
    
    public function validatefaqAction() {
        $this->_helper->getHelper('layout')->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $form = new Application_Form_Admin_Faq_Add();
        $response = $form->processAjax($_POST);
        if ($response !== null) {
            $this->getResponse()->setHeader('Content-type', 'application/json')->setBody($response);
        }
    }
    
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
