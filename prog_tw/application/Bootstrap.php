<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
     
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
        
    
    }

}

