<?php

class PublicController extends Zend_Controller_Action {

    protected $_logform;
    protected $_authService;
    protected $_catalogModel;
    protected $_logged;
    protected $_signform;
    protected $_searchform;

    public function init() {
        //creo un istanza del model che userò per la visualizzazione delle promozioni-aziende etc
        //questo model contiene tutte le query dell'area pubblica
        $this->_catalogModel = new Application_Model_Catalog();

        $this->_authService = new Application_Service_Auth();

        //imposto come layouy il file main.phtml
        $this->_helper->layout->setLayout('main');

        //se la richiesta è fatta da un utente registrato prendo il menu corrispondente, 
        //altrimenti assegno il menù di default
        //e recupero la form di login(che non serve se l'utente è già loggato
        if (isset($this->_authService->getIdentity()->role)) {
            $this->view->assign(array('menu' => $this->_authService->getIdentity()->role . "/_menu.phtml"));
            $this->view->assign(array('topbar' => $this->_authService->getIdentity()->role . "/_topbar.phtml"));
        } else {
            $this->view->assign(array('menu' => "_menu.phtml"));
            $this->view->loginForm = $this->getLoginForm();
            $this->view->assign(array('topbar' => "_topbar.phtml"));
        }

        //recupero la form per la ricerca delle promozioni e per la registrazione
        $this->view->signinForm = $this->getSigninForm();
        $this->view->searchForm = $this->getSearchForm();
    }

  
    //****************************************
    //             ACQUISTO
    //****************************************
    public function acquistoAction() {

        $this->view->assign(array('stampa' => '_stampa.phtml'));
    }

    //****************************************
    //              RPOMOZIONI
    //****************************************
    public function promoAction() {

        $paged = $this->_getParam('page', 1);
        $ordine = $this->_getParam('order', null); //da modificare

        $promozioni = $this->_catalogModel->getProms($paged, $ordine);


        $this->view->assign(array(
            'promozioni' => $promozioni
                )
        );
    }

    //****************************************
    //     VISUALIZZATORE PAGINE STATICHE
    //****************************************
    public function viewstaticAction() {
        //mi permette di impostare la view da visualizare
        //di default viene visualizzata la vista con il nome dell'action
        //in questo caso il viewHelper render impone una vista diversa
        //così posso parametrizzare la scelta della vista che sarà in questo caso
        //who o where
        $page = $this->_getParam('staticPage');
        $this->render($page);
    }

    //****************************************
    //                AZIENDE
    //****************************************
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

    //****************************************
    //                FAQ
    //****************************************
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

    //****************************************
    //           AREA RISERVATA
    //****************************************
    public function reservedareaAction() {
        $this->_helper->redirector('index', 'staff');

    }

    //****************************************
    //                LOGIN
    //****************************************
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

    // Validazione AJAX
    public function validateloginAction() {
        $this->_helper->getHelper('layout')->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $loginform = new Application_Form_Public_Login();
        $response = $loginform->processAjax($_POST);
        if ($response !== null) {
            $this->getResponse()->setHeader('Content-type', 'application/json')->setBody($response);
        }
    }

    //****************************************
    //              REGISTRAZIONE
    //****************************************
    public function signinAction() {
        $this->view->signinForm = $this->getSigninForm();
    }

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

        if (false === $this->_authService->authenticate($form->getValues())) {
            $form->setDescription('Autenticazione fallita. Riprova');
            return $this->render('login');
        }
        return $this->_helper->redirector('index', $this->_authService->getIdentity()->role);

        //$this->_helper->redirector('index');
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
  
    // Validazione AJAX
    public function validatesigninAction() {
        $this->_helper->getHelper('layout')->disableLayout();
        $this->_helper->viewRenderer->setNoRender();

        $signform = new Application_Form_Public_Signin();
        $response = $signform->processAjax($_POST);
        if ($response !== null) {
            $this->getResponse()->setHeader('Content-type', 'application/json')->setBody($response);
        }
    }
  
    //****************************************
    //                RICERCA
    //****************************************    

    public function searchAction() {
        if (!$this->getRequest()->isPost()) {
            $this->_helper->redirector('promo');
        }
        $form = $this->_searchform;
        if (!$form->isValid($_POST)) {
            $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
            return $this->render('promo');
        }

        $this->values = $form->getValues();   
        // $this->cache->load("prova");
        // $this->cache->save($this->values["ID_Categoria"], "ID_Categoria");
        // $this->cache->save($this->values["words"], "words");
        
        //L'UNICA COSA CHE MANCA QUI è DI RIUSCIRE A PASSARE VALUES ALLA FINDACTION, MI DICE CHE UN'AZIONE NON PUò AVERE PARAMETRI
        $this->findAction();
    }

    public function findAction( ) {
        $paged = $this->_getParam('page', 1);
        $ordine = $this->_getParam('order', null);
        if ($this->values) {
            $trovate = $this->_catalogModel->search($this->values, $paged, $ordine);
            $this->view->assign(array(
                'trovate' => $trovate
                    )
            );

            $this->view->assign(array('ID_Categoria' => $this->values["ID_Categoria"], 'words' => $this->values["words"]));
        } else {
            $this->values["ID_Categoria"] = $this->_getParam('ID_Categoria', null);
            $this->values["words"] = $this->_getParam('words', null);
            $trovate = $this->_catalogModel->search($this->values, $paged, $ordine);
            $this->view->assign(array(
                'trovate' => $trovate
                    )
            );

            $this->view->assign(array('ID_Categoria' => $this->values["ID_Categoria"], 'words' => $this->values["words"]));
            $this->_helper->redirector('search');
        }
    }

    //QUEST'AZIONE FUNZIONAVA MA QUANDO FACCIO SUCCESSIVO NON PRENDE I VALORI E NON LI PASSA ALLA VIEW GIUSTA
    /* public function searchAction() {
      if (!$this->getRequest()->isPost()) {
      $this->_helper->redirector('promo');
      }
      $form = $this->_searchform;
      if (!$form->isValid($_POST)) {
      $form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
      return $this->render('promo');
      }
      $values = $form->getValues();

      $paged = $this->_getParam('page', 1);
      $ordine = $this->_getParam('order', null);

      $trovate=$this->_catalogModel->search($values, $paged, $ordine);

      $this->view->assign(array(
      'trovate' => $trovate
      )
      );

      $this->view->assign(array('search', 'public'));
      } */

    private function getSearchForm() {
        $urlHelper = $this->_helper->getHelper('url');
        $this->_searchform = new Application_Form_Public_Search();
        $this->_searchform->setAction($urlHelper->url(array(
                    'controller' => 'public',
                    'action' => 'search'), 'default'
        ));
        return $this->_searchform;
    }

    //****************************************
    //       MODIFICA PROFILO UTENTE
    //****************************************
    function modificaprofiloAction() {
        
    }

}
