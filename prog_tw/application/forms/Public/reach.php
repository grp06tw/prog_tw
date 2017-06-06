<?php

class Application_Form_Public_Reach extends App_Form_Abstract {

    protected $_catalogModel;

    public function init() {
        $this->_catalogModel = new Application_Model_Catalog();
        $this->setMethod('post');
        $this->setName('reach');
        $this->setAction('');
        
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

        /*$this->setDecorators(array(
            'FormElements',
            'Form'
        ));*/
 
 
    }

}
