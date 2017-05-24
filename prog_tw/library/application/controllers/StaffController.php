<?php

class StaffController extends Zend_Controller_Action
{
	protected $_staffModel;
	protected $_form;


	public function init()
	{
		$this->_helper->layout->setLayout('main');
		$this->_staffModel = new Application_Model_Staff();
		$this->view->newpromoForm = $this->getAddPromoForm();
                $this->view->assign(array('menu' => "_menustaff.phtml"));
                 $this->view->assign(array('topbar' => "_topbar.phtml"));
	}

	public function indexAction()
	{}
        
        
        public function newpromoAction()//VAFFF***O
	{}
        
        
	public function addpromoAction()
	{
		if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index');
		}
		$form=$this->_form;
		if (!$form->isValid($_POST)) {
			$form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
			return $this->render('newpromo');
		}
		$values = $form->getValues();
		$this->_staffModel->savePromo($values);
		$this->_helper->redirector('index');
	}

	private function getAddPromoForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_Staff_Promo_Add();
		$this->_form->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'addpromo'),
				'default'
				));
		return $this->_form;
	}
}
