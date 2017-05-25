<?php
class Application_Form_Staff_Promo_Select extends App_Form_Abstract
{
	protected $_staffModel;

	public function init()
	{
		$this->_staffModel = new Application_Model_Staff();
		$this->setMethod('post');
		$this->setName('selectpromo');
		$this->setAction('');
		$this->setAttrib('enctype', 'multipart/form-data');
                
//PROMOZIONE                
		$promotions = array();
		$promos = $this->_staffModel->getProms();
		foreach ($promos as $promo) {
			$promotions[$promo -> ID_Promozione] = $promo->titolo;
		}
		$this->addElement('select', 'ID_Promozione', array(
                                    'label' => 'Promozione',
                                    'required' => true,
                                    'multiOptions' => $promotions,
                                    'decorators' => $this->elementDecorators,
		));

//SUBMIT 		
		$this->addElement('submit', 'update', array(
                                    'label' => 'Modifica Promozione',
                                    'decorators' => $this->buttonDecorators,
		));

		$this->setDecorators(array(
			'FormElements',
			array('HtmlTag', array('tag' => 'table')),
			array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
			'Form'
		));
	}
}