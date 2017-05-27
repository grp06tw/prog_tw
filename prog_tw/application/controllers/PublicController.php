<?php

class PublicController extends Zend_Controller_Action {

    //protected $_logger;
    protected $_logform;
    protected $_authService;
    protected $_catalogModel;

    public function init() {
        //imposto come layouy il file main.phtml
        $this->_helper->layout->setLayout('main');
        $this->view->assign(array('menu' => "_menu.phtml"));
        $this->view->assign(array('topbar' => "_topbar.phtml"));
        $this->view->loginForm = $this->getLoginForm();
        $this->_catalogModel = new Application_Model_Catalog();
        $this->_authService = new Application_Service_Auth();
    }

    public function indexAction() {

        $this->_helper->redirector('promo', 'public');
    }

    public function promoAction() {

        $paged = $this->_getParam('page', 1);
        $ordine = $this->_getParam('order', null); //da modificare

        $promozioni = $this->_catalogModel->getProms($paged, $ordine);


        $this->view->assign(array(
            'promozioni' => $promozioni
                )
        );
    }

    public function viewstaticAction() {
        //mi permette di impostare la view da visualizare
        //di default viene visualizzata la vista con il nome dell'action
        //in questo caso il viewHelper render impone una vista diversa
        //così posso parametrizzare la scelta della vista che sarà in questo caso
        //who o where
        $page = $this->_getParam('staticPage');
        $this->render($page);
    }

    public function aziendeAction() {
        //$this->view->assign(array('text' => "LOREM IPSUM"));
        // controlla se _catalogModel è già istanziato
        // if(!_catalogModel)

        $paged = $this->_getParam('page', 1);
        $ordine = $this->_getParam('order', null); //da modificare

        $aziende = $this->_catalogModel->getAziende($paged, $ordine);


        $this->view->assign(array(
            'aziende' => $aziende
                )
        );

        $this->view->assign(array('aziende', 'public'));
    }

    public function faqAction() {
        $this->view->assign(array('text' => "LOREM IPSUM"));
    }

    public function reservedareaAction() {
        $this->_helper->redirector('index', 'staff');
    }

    //LOGIN
    public function loginAction() {
        
    }

    public function authenticateAction() {
        $request = $this->getRequest();
        if (!$request->isPost()) {
            return $this->_helper->redirector('login');
        }
        $form = $this->_logform;
        if (!$form->isValid($request->getPost())) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('login');
        }
        if (false === $this->_authService->authenticate($form->getValues())) {
            $form->setDescription('Autenticazione fallita. Riprova');
            return $this->render('login');
        }
        return $this->_helper->redirector('index', $this->_authService->getIdentity()->role);
    }

    private function getLoginForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_logform = new Application_Form_Public_Login();
        $this->_logform->setAction($urlHelper->url(array(
                    'controller' => 'public',
                    'action' => 'authenticate'), 'default'
        ));
        return $this->_logform;
    }

}
