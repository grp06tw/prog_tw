<?php

class StaffController extends Zend_Controller_Action
{
	protected $_staffModel;
	protected $_addform;
        protected $_delform;
        protected $_selform;


	public function init()
	{
		$this->_helper->layout->setLayout('main');
		$this->_staffModel = new Application_Model_Staff();
		$this->view->newpromoForm = $this->getAddPromoForm();
                $this->view->deletepromoForm = $this->getDeletePromoForm();
                $this->view->selectupdateForm = $this->getSelectUpdateForm();
                $this->view->assign(array('menu' => "staff/_reservedmenu.phtml"));
                $this->view->assign(array('topbar' => "_topbar.phtml"));
	}

	public function indexAction()
	{}
        
     
        
        
        //ADD PROMO       
       
        public function newpromoAction()
	{}
        
        
	public function addpromoAction()
	{
		if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index');
		}
		$form=$this->_addform;
		if (!$form->isValid($_POST)) {
			$form->setDescription('Attenzione: alcuni dati inseriti sono errati.');
			return $this->render('newpromo');
		}
		$values = $form->getValues();
		$this->_staffModel->savePromo($values);
		$this->_helper->redirector('index');
	}

	
        
        
        //DELETE PROMO
        
         public function deletepromoAction()
	{}
        
        
	public function delpromoAction()
	{
		if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index');
		}
		$form=$this->_delform;
		if (!$form->isValid($_POST)) {
			$form->setDescription('operazione non riuscita');
			return $this->render('deletepromo');
		}
		$values = $form->getValues();
		$this->_staffModel->delPromo($values);
		$this->_helper->redirector('deletepromo');
	}

	
        
        
         //UPDATE PROMO       
         public function updatepromoAction()
	{}
        
        
	public function updpromoAction()
	{
		if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index');
		}
		$form=$this->_addform;
		if (!$form->isValid($_POST)) {
			$form->setDescription('operazione non riuscita');
			return $this->render('updatepromo');
		}
		$values = $form->getValues();
		//UPDATE
                $this->_staffModel->updatePromo($values);
		$this->_helper->redirector('updatepromo');
	}

     
       
        
        public function popolateAction()
	{
		 if (!$this->getRequest()->isPost()) {
			$this->_helper->redirector('index');
		}
		$form=$this->_selform;
		if (!$form->isValid($_POST)) {
			$form->setDescription('operazione non riuscita');
			return $this->render('updatepromo');
		}
		$values = $form->getValues();
                $this->view->updatepromoForm = $this->getUpdatePromoForm($values);
	}

        
        
        //RECUPERO LE FORM
            //ADD
        private function getAddPromoForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
		$this->_addform = new Application_Form_Staff_Promo_Add();
		$this->_addform->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'addpromo'),
				'default'
				));
		return $this->_addform;
	}
        
            //DELETE
        private function getDeletePromoForm()
	{
		$urlHelper = $this->_helper->getHelper('url');
		$this->_delform = new Application_Form_Staff_Promo_Delete;
		$this->_delform->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'delpromo'),
				'default'
				));
		return $this->_delform;
	}
        
            //UPDATE
         //Seleziona la promo da modificare
        private function getSelectUpdateForm(){
		$urlHelper = $this->_helper->getHelper('url');
		$this->_selform = new Application_Form_Staff_Promo_Select();
		$this->_selform->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'popolate'),
				'default'
				));
		return $this->_selform;
	}
        
        	private function getUpdatePromoForm($values)
	{
		$urlHelper = $this->_helper->getHelper('url');
		$this->_addform = new Application_Form_Staff_Promo_Add($values);
		$this->_addform->setAction($urlHelper->url(array(
				'controller' => 'staff',
				'action' => 'updpromo'),
				'default'
				));
		return $this->_addform;
	}
}
