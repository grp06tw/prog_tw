<?php

class UserController extends Zend_Controller_Action
{	
    private $_authService;
    public function init()
    {
		$this->_helper->layout->setLayout('main');
                $this->view->assign(array('menu' => "user/_menu.phtml"));
                $this->view->assign(array('topbar' => "_topbar.phtml"));
		$this->_authService = new Application_Service_Auth();
    }

    public function indexAction()
    {}  

    public function logoutAction()
	{
		$this->_authService->clear();
		return $this->_helper->redirector('index','public');	
	}
    
}

