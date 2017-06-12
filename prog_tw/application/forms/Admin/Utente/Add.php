<?php

class Application_Form_Admin_Utente_Add extends App_Form_Abstract {

    protected $_adminModel;

    public function init() {

        $this->_adminModel = new Application_Model_Admin();
        $this->setMethod('post');
        $this->setName('addutente');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');


        //ID  -> Serve per la update
        $this->addElement('hidden', 'ID_Utente', array(
            'filters' => array('StringTrim'),
            'show' => 'none',
            'decorators' => $this->elementDecorators,
        ));

//USERNAME
        $this->addElement('text', 'Username', array(
            'label' => 'Username',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1, 30))),
            'decorators' => $this->elementDecorators,
        ));
//PASSWORD
        $this->addElement('text', 'password', array(
            'label' => 'Password',
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

//COGNOME
        $this->addElement('text', 'cognome', array(
            'label' => 'Cognome',
            'filters' => array('StringTrim'),
            'required' => true,
            'validators' => array(array('StringLength', true, array(1, 30))),
            'decorators' => $this->elementDecorators,
        ));
 //GENERE
$this->addElement('radio', 'genere', array(
            'label' => 'Genere',
            'multiOptions' => array(
                'm' => 'M',
                'f' => 'F',
                'x' => 'X'
            ),
            'decorators' => $this->radioDecorators,
        ));
//ETA
        for($i=(int)(date('Y'));$i>=1920;$i--) {
			$eta[$i] = $i;
		}
        $this->addElement('select', 'eta', array(
            'label' => 'Data di nascita',
            'required' => true,
            'multiOptions' => $eta,
            'decorators' => $this->elementDecorators
        ));
//TELEFONO
        $this->addElement('text', 'telefono', array(
            'label' => 'Telefono',
            'filters' => array('StringTrim'),
            'validators' => array(array('StringLength', true, array(9, 12))), 
            'decorators' => $this->elementDecorators,
        ));
//INDIRIZZO        
        $this->addElement('textarea', 'indirizzo', array(
            //'filters' => array('StringTrim', 'StringToLower'),
            'cols' => '30', 'rows' => '3',
            'validators' => array(
                array('StringLength', true, array(10, 100))
            ),
            'label' => 'Indirizzo',
            'decorators' => $this->elementDecorators,
        ));
//EMAIL
        $this->addElement('text', 'email', array(
            //'filters' => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(10, 30))
            ),
            'required' => true,
            'label' => 'Email',
            'decorators' => $this->elementDecorators,
        ));
//RUOLO        
        $role["user"] = "user";
        $role["staff"] = "staff";
        $role["admin"] = "admin";
        $this->addElement('select', 'role', array(
            'required' => true,
            'multiOptions' => $role,
            'show' => 'none',
            'decorators' => $this->elementDecorators,
        ));
//SUBMIT
        $this->addElement('submit', 'add', array(
            'label' => 'Conferma',
            'decorators' => $this->buttonDecorators,
        ));

        $this->setDecorators(array(
            'FormElements',
            array('HtmlTag', array('tag' => 'table', 'class' => 'zend_form')),
            array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
            'Form'
        ));

    }

}
