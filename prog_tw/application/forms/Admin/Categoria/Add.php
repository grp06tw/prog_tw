<?php

class Application_Form_Admin_Categoria_Add extends App_Form_Abstract {

    protected $_adminModel;

    public function init() {

        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('addcategoria');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');


        //ID  -> Serve per la update
        $this->addElement('hidden', 'ID_Categoria', array(
            'filters' => array('StringTrim'),
            'show' => 'none',
            'decorators' => $this->elementDecorators,
        ));

//NOME
        $this->addElement('text', 'nome', array(
            'label' => 'Nome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1, 30))),
            'decorators' => $this->elementDecorators,
        ));
    
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
