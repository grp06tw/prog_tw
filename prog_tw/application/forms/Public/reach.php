<?php

class Application_Form_Public_Search extends App_Form_Abstract {

    protected $_catalogModel;

    public function init() {
        $this->_catalogModel = new Application_Model_Catalog();
        $this->setMethod('post');
        $this->setName('search');
        $this->setAction('');

        $this->setDecorators(array(
            'FormElements',
            'Form'
        ));
 
 
    }

}
