<?php

class Application_Form_Public_Reach extends App_Form_Abstract {

    protected $_catalogModel;

    public function init() {
        $this->_catalogModel = new Application_Model_Catalog();
        $this->setMethod('post');
        $this->setName('reach');
        $this->setAction('');
        //$this->addAttribs(array("class" => "src", "id" => "form_src"));


        $categories = array();
        $categories ["null"] = "Tutte le categorie";
        
        
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
