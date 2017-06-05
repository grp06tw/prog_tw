<?php
class Application_Form_Admin_Azienda_Delete extends App_Form_Abstract
{
	protected $_adminmodel;

	public function init()
	{
		$this->_adminmodel = new Application_Model_Admin();
		$this->setMethod('post');
		$this->setName('deleteazienda');
		$this->setAction('');
		$this->setAttrib('enctype', 'multipart/form-data');
                
//PROMOZIONE                
		$aziende = array();
		$az = $this->_adminmodel->getAziende();
		foreach ($az as $azienda) {
			$aziende[$azienda -> ID_Azienda] = $azienda->nome;
		}
		$this->addElement('select', 'ID_Azienda', array(
                                    'label' => 'Azienda',
                                    'required' => true,
                                    'multiOptions' => $aziende,
                                    'decorators' => $this->elementDecorators,
		));

//SUBMIT 		
		$this->addElement('submit', 'delete', array(
                                    'label' => 'Elimina Azienda',
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