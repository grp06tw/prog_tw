<?php

class Application_Form_Admin_Faq_Delete extends App_Form_Abstract {

    protected $_adminmodel;

    public function init() {
        $this->_adminmodel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('deletefaq');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');

//-----FAQ-----//              
        $faq = array();
        $fa = $this->_adminmodel->getFaq();
        foreach ($fa as $faq1) {
            $faq[$faq1->ID_Faq] = $faq1->nome;
        }
        $this->addElement('select', 'ID_Faq', array(
            'label' => 'Faq',
            'required' => true,
            'multiOptions' => $faq,
            'decorators' => $this->elementDecorators,
        ));

//-----SUBMIT-----//
        $this->addElement('submit', 'delete', array(
            'label' => 'Elimina Faq',
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
