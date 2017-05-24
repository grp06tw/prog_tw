<?php

class PublicController extends Zend_Controller_Action {
    
    protected $_logger;

    
    public function init() {
        //imposto come layouy il file main.phtml
        $this->_helper->layout->setLayout('main');
        $this->view->assign(array('menu' => "_menu.phtml"));
        $this->view->assign(array('topbar' => "_topbar.phtml"));
    }
    
    public function indexAction() {
        $this->_catalogModel = new Application_Model_Catalog(); //Instanzio il model
        
      
        
        $paged = $this->_getParam('page', 1);
        $ordine = $this->_getParam('order', null);//da modificare
        
        $promozioni=$this->_catalogModel->getProms($paged,$ordine);
        
        
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
        $this->view->assign(array('text' => "LOREM IPSUM"));
    }
    
    public function faqAction() {
        $this->view->assign(array('text' => "LOREM IPSUM"));  
    }
    
    public function reservedareaAction() {
        $this->_helper->redirector('index','staff');
    }
}
