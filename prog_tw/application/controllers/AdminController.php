<?php

class AdminController extends Zend_Controller_Action {

    protected $_adminModel;
    protected $_authService;
    protected $_newAzform;

    public function init() {
        $this->_helper->layout->setLayout('main');
        $this->view->assign(array('menu' => "admin/_reservedmenu.phtml"));
        $this->view->assign(array('topbar' => "_topbar.phtml"));
        $this->_adminModel = new Application_Model_Admin();
        $this->_authService = new Application_Service_Auth();

        $this->view->newaziendaform = $this->getAddAziendaForm();
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
    //             MODIFICA PROMO
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
            return $this->render('modazienda');
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
