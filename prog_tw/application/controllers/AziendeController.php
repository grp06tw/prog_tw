<?php

class AziendeController extends Zend_Controller_Action {


    public function init() {
        $this->_helper->layout->setLayout('main');

    }
    
    public function visualizzaAction() {
        $this->view->assign(array('text' => "LOREM IPSUM"));
        
    }
}