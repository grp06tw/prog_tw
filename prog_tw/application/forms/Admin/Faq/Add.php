<?php

class Application_Form_Admin_Faq_Add extends App_Form_Abstract {

    protected $_adminmodel;

    public function init() {

        $this->_adminmodel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('addfaq');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');

        $this->addElement('hidden', 'ID_Faq', array(
            'filters' => array('StringTrim'),
            'show' => 'none',
            'decorators' => $this->elementDecorators,
        ));


        //-----ID FAQ-----//
        $this->addElement('hidden', 'ID_Faq', array(
            'filters' => array('StringTrim'),
            'show' => 'none',
            'decorators' => $this->elementDecorators,
        ));

        //-----DOMANDA FAQ-----//
        $this->addElement('textarea', 'domanda', array(
            'cols' => '60', 'rows' => '5',
            'label' => 'Domanda',
            'autofocus' => 'autofocus',
            'filters' => array('StringTrim'),
            'required' => true,
            'decorators' => $this->elementDecorators,
        ));

        //-----RISPOSTA FAQ-----//
        $this->addElement('textarea', 'risposta', array(
            'cols' => '60', 'rows' => '10',
            'label' => 'Risposta',
            'filters' => array('StringTrim'),
            'required' => true,
            'decorators' => $this->elementDecorators,
        ));

        //-----SUBMIT-----// 		
        $this->addElement('submit', 'add', array(
            'label' => 'Conferma',
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
