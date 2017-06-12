<?php

class Application_Form_Public_Signin extends App_Form_Abstract {

    public function init() {
        $this->setMethod('post');
        $this->setName('signin');
        $this->setAction('');

        $this->addElement('text', 'Username', array(
            'filters' => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 30))
            ),
            'required' => true,
            'label' => 'Username',
            'autofocus' => 'autofocus',
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('password', 'password', array(
            'filters' => array('StringTrim'),
            'validators' => array(
                array('StringLength', true, array(3, 30))
            ),
            'required' => true,
            'label' => 'Password',
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('text', 'nome', array(
            'filters' => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 30))
            ),
            'required' => true,
            'label' => 'Nome',
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('text', 'cognome', array(
            'filters' => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(3, 30))
            ),
            'required' => true,
            'label' => 'Cognome',
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('radio', 'genere', array(
            'label' => 'Genere',
            'multiOptions' => array(
                'm' => 'M',
                'f' => 'F',
                'x' => 'X'
            ),
            'decorators' => $this->radioDecorators,
        ));

        for ($i = (int) (date('Y')); $i >= 1920; $i--) {
            $eta[$i] = $i;
        }
        $this->addElement('select', 'eta', array(
            'label' => 'Data di nascita',
            'required' => true,
            'multiOptions' => $eta,
            'decorators' => $this->elementDecorators
        ));

        $this->addElement('text', 'telefono', array(
            'label' => 'Telefono',
            'filters' => array('StringTrim'),
            'validators' => array(array('StringLength', true, array(9, 12))),
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('textarea', 'indirizzo', array(
            //'filters' => array('StringTrim', 'StringToLower'),
            'cols' => '30', 'rows' => '3',
            'validators' => array(
                array('StringLength', true, array(10, 100))
            ),
            'label' => 'Indirizzo',
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('text', 'email', array(
            //'filters' => array('StringTrim', 'StringToLower'),
            'validators' => array(
                array('StringLength', true, array(10, 30))
            ),
            'required' => true,
            'label' => 'Email',
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('hidden', 'role', array(
            'required' => true,
            'value' => 'user',
            'show' => 'none',
            'decorators' => $this->elementDecorators,
        ));

        $this->addElement('submit', 'signin', array(
            'label' => 'Registrami',
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
