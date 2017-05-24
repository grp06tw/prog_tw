<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    protected $_logger;
    protected $_view;

    protected function _initLogging()
    {
        $writer = new Zend_Log_Writer_Stream(APPLICATION_PATH . '/data/log/logFile.log');        
        $logger = new Zend_Log($writer); 

        //la prossima ints mi permette di utilizzare l'oggetto logger,
        // di classe Zend_log, non solo qui nel bootstrap, dove è stato creato,
        //ma lo metto nell'oggetto pubblico Zend_Registry (singleton)
        //accessibile da tutti gli oggetti del progetto, rendendolo disponibile in
        //qualunque parte della mia application
        Zend_Registry::set('log', $logger);
        
        //in questo modo (non è necessario perche sta gia qui, ma lo farò in tutti gli altri casi)
        //richiamo  il logger dallo Zend_Registry
        $this->_logger = $logger;
        
        //così faccio stampare nel file di log una nuova stringa tramite il metodo info()
    	$this->_logger->info('Bootstrap ' . __METHOD__);
    }
     
      protected function _initRequest()
	// Aggiunge un'istanza di Zend_Controller_Request_Http nel Front_Controller
	// che permette di utilizzare l'helper baseUrl() nel Bootstrap.php
	// Necessario solo se la Document-root di Apache non è la cartella public/
    {
        $this->bootstrap('FrontController');
        $front = $this->getResource('FrontController');
        $request = new Zend_Controller_Request_Http();
        $front->setRequest($request);
    }
    
    protected function _initViewSettings()
    {
        //genero l'oggetto vista dell'applicazione
        $this->bootstrap('view');
        //forza la creazione dell'oggetto, per poter modificare anticipatamente alcune proprietà della vista
        $this->_view = $this->getResource('view');
        //uso i view helper per generare le tag da inserire nella pagina
        //nelle tag meta, link e title
        $this->_view->headMeta()->setCharset('UTF-8');
        $this->_view->headMeta()->appendHttpEquiv('Content-Language', 'it-IT');
	//$this->_view->headLink()->appendStylesheet('/css/style.css');
        $this->_view->headLink()->appendStylesheet($this->_view->baseUrl('css/style.css'));
        $this->_view->headTitle('123Cupon!');
        
        $this->view->assign(array('logo' => $this->view->baseUrl('css/img/logo.png')));
        
        
    
    }
    
    //Definisce la ShortCut
    protected function _initDefaultModuleAutoloader()
    {
    	$loader = Zend_Loader_Autoloader::getInstance();
		$loader->registerNamespace('App_');
        $this->getResourceLoader()
             ->addResourceType('modelResource','models/resources','Resource');
  	}

}

