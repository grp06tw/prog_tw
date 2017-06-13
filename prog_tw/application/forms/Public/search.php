<?php

class Application_Form_Public_Search extends App_Form_Abstract {

    protected $_catalogModel;

    public function init() {
        $this->_catalogModel = new Application_Model_Catalog();
        $this->setMethod('post');
        $this->setName('search');
        $this->setAction('');
        $this->addAttribs(array("class" => "src", "id" => "form_src"));


        $categories = array();
        $categories ["null"] = "Tutte le categorie";

        $cats = $this->_catalogModel->getCats();
        foreach ($cats as $cat) {
            $categories[$cat->ID_Categoria] = $cat->nome;
        }


        $this->addElement('select', 'ID_Categoria', array(
            'required' => true,
            'multiOptions' => $categories,
            'decorators' => $this->searchDecorators,
            'id' => 'cat_src',
        ));


        $this->addElement('text', 'words', array(
            'filters' => array('StringTrim', 'StringToLower'),
            'id' => 'desc_src',
            'placeholder' => 'Cerca',
            'filters' => array('StringTrim'),
            'decorators' => $this->searchDecorators
        ));

        $this->addElement('submit', 'cerca', array(
            'label' => 'Cerca',
            "id" => "submit_src",
            'decorators' => $this->searchDecorators
        ));

        $this->setDecorators(array(
            'FormElements',
            'Form'
        ));
    }

}
