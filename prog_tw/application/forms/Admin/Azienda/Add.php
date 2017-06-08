<?php

class Application_Form_Admin_Azienda_Add extends App_Form_Abstract {

    protected $_adminModel;

    public function init() {

        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        //$this->setName('addpromo');
        $this->setName('addazienda');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');


        //ID  -> Serve per la update
        $this->addElement('hidden', 'ID_Azienda', array(
            'filters' => array('StringTrim'),
            'show' => 'none',
            'decorators' => $this->elementDecorators,
        ));

//RAGIONE SOCIALE
        $this->addElement('text', 'ragione_sociale', array(
            'label' => 'Ragione Sociale',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1, 30))),
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

//Logo                
        $this->addElement('file', 'logo', array(
            'label' => 'Logo',
            'destination' => APPLICATION_PATH . '/../public/img/promo',
            'validators' => array(
                array('Count', false, 1),
                array('Size', false, 1048576),
                array('Extension', false, array('jpg', 'gif'))),
            'decorators' => $this->fileDecorators,
        ));

        //INDIRIZZO
        $this->addElement('text', 'indirizzo', array(
            'label' => 'Indirizzo',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1, 100))),
            'decorators' => $this->elementDecorators,
        ));


//DESCRIZIONE
        $this->addElement('textarea', 'descrizione', array(
            'label' => 'Descrizione',
            'cols' => '60', 'rows' => '20',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1, 2500))),
            'decorators' => $this->elementDecorators,
        ));



//SUBMIT 		
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
