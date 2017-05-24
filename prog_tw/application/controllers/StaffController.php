<?php

class StaffController extends Zend_Controller_Action
{
	protected $_staffModel;
	protected $_form;


	public function init()
	{
		$this->_helper->layout->setLayout('main');
		$this->_staffModel = new Application_Model_Staff();
		$this->view->promoForm = $this->getProductForm();
	}

	public function indexAction()
	{
            $this->_helper->layout->setLayout('main');
            $this->view->assign(array('menu' => "_menu.phtml"));
            $this->view->assign(array('topbar' => "_topbar.phtml"));
            $this->view->assign(array('menu' => "_menustaff.phtml"));
        }
        
	public function newpromoAction()
	{
		/*if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index');
		}*/
		$form=$this->_form;
		if (!$form->isValid($_POST)) {
			$form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
			return $this->render('newpromo');
		}
		$values = $form->getValues();
		$this->_staffModel->saveProduct($values);
		$this->_helper->redirector('newpromo');//modificare rimanda all index dell'area ris
	}

	private function getProductForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
		$this->_form = new Application_Form_Staff_Promo_Add();
		$this->_form->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'newpromo'),
				'default'
				));
		return $this->_form;
	}
}
