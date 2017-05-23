<?php

class PublicController extends Zend_Controller_Action {

    protected $_testo = '<p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est. </p><p>Sed lacus. Donec lectus. Nullam pretium nibh ut turpis. Nam bibendum. In nulla tortor, elementum vel, tempor at, varius non, purus. Mauris vitae nisl nec metus placerat consectetuer. Donec ipsum. Proin imperdiet est. Phasellus dapibus semper urna. Pellentesque ornare, orci in consectetuer hendrerit, urna elit eleifend nunc, ut consectetuer nisl felis ac diam. Etiam non felis. Donec ut ante. In id eros. Suspendisse lacus turpis, cursus egestas at sem. Phasellus pellentesque. Mauris quam enim, molestie in, rhoncus ut, lobortis a, est.</p>';

    protected $_logger;

    
    public function init() {
        //imposto come layouy il file main.phtml
        $this->_helper->layout->setLayout('main');
        $this->view->assign(array('menu' => "_menu.phtml"));
    }
    
    public function indexAction() {
        $this->view->assign(array('text' => $this->_testo));
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
        $this->view->assign(array('menu' => "_menu2.phtml"));
    }
    
    public function faqAction() {
        $this->view->assign(array('text' => "LOREM IPSUM"));
        
    }
}
