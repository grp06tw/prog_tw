<?php

class PublicController extends Zend_Controller_Action {

    //protected $_logger;
    protected $_logform;
    protected $_authService;
    protected $_catalogModel;
    protected $_logged;
    
    //protected $_signform;

    public function init() {
        //imposto come layouy il file main.phtml
        $this->_helper->layout->setLayout('main');
        $this->_logged=$this->_getParam('logged');
        if($this->_logged){
            $this->view->assign(array('menu' => $this->_logged."/_menu.phtml"));
            $this->view->assign(array('topbar' => $this->_logged."/_topbar.phtml"));
        }
        else{
            $this->view->assign(array('menu' => "_menu.phtml"));
            $this->view->loginForm = $this->getLoginForm();
            $this->view->assign(array('topbar' => "_topbar.phtml"));
        }
        
        $this->_catalogModel = new Application_Model_Catalog();
        $this->_authService = new Application_Service_Auth();
        
        $this->view->signinForm = $this->getSigninForm();
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
        
        $paged = $this->_getParam('page', 1);
        $ordine = $this->_getParam('order', null); //da modificare

        $faqs = $this->_catalogModel->getFaq($paged, $ordine);


        $this->view->assign(array(
            'faq' => $faqs
                )
        );

        $this->view->assign(array('faq', 'public'));
        
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
    
    //REGISTRAZIONE
    public function signinAction() {
        $this->view->signinForm = $this->getSigninForm();
    }
    
    /*public function newuserAction() {
        
    }*/

    public function adduserAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('index'); //a cosa serve?
        }
        $form = $this->_signform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('signin');
        }
        $values = $form->getValues();
        $this->_catalogModel->saveUser($values);
        $this->_helper->redirector('index');
    }
    
    private function getSigninForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_signform = new Application_Form_Public_Signin();
        $this->_signform->setAction($urlHelper->url(array(
                    'controller' => 'public',
                    'action' => 'adduser'), 'default'
        ));
        return $this->_signform;
    }

}
