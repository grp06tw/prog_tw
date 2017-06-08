<?php

class Application_Form_Public_Signin extends App_Form_Abstract {

    public function init() {
        $this->setMethod('post');
        $this->setName('signin');
        $this->setAction('');
//QUESTO FILE E' DA ELIMINARE!!! NON SERVE A NIENTE
        
        /*
        $this->addElement('hidden', 'ID_Utente', array(
            'required' => true,
            'value' => 'user',
            'show' => 'none',
        ));
         */

        $this->addElement('submit', 'cerca', array(
            'label' => 'Ottieni',
            "id"=>"submit_buy",
            "value"=>"Ottieni",
            //'decorators' => $this->searchDecorators
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
