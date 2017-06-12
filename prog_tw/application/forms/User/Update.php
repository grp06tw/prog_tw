<?php
class Application_Form_User_Update extends App_Form_Abstract{
    public function init(){
        $this->setMethod('post');
        $this->setName('updatedata');
        $this->setAction('');
        $this->setAttrib('enctype', 'multipart/form-data');
// SE QUALCHE CAMPO E' DI TROPPO BASTA TOGLIERLO, INTANTO HO RESO MODIFICABILE TUTTO AD ESC DI ID USERNAME E RUOLO
//ID
        $this->addElement('hidden','ID_Utente',
                array(
                    'show' => 'none',
                    'decorators' => $this->elementDecorators 
                    )
                );
//PASSWORD
        $this->addElement('text','password',
                array(
                    'label' => 'Password',
                    'validators' => array(array('StringLength', true, array(3, 30))),
                    'decorators' => $this->elementDecorators 
                    )
            );
//NOME
        $this->addElement('text','nome',
            array(
                'label' => 'Nome',
                'filters' => array('StringTrim', 'StringToLower'),
                'validators' => array(array('StringLength', true, array(3, 30))),
                'decorators' => $this->elementDecorators
                )
            );
//COGNOME
        $this->addElement('text','cognome',
            array(
                'label' => 'Cognome',
                'filters' => array('StringTrim', 'StringToLower'),
                'validators' => array(array('StringLength', true, array(3, 30))),
                'decorators' => $this->elementDecorators
                )
            );

//GENERE
        $this->addElement('radio', 'genere', 
            array(
                'label' => 'Genere',
                'multiOptions' => array('m' => 'M','f' => 'F'),
                'decorators' => $this->radioDecorators
                )
            );
//ETA'
        for($i=(int)(date('Y'));$i>=1920;$i--) {
            $eta[$i] = $i;
        }
        $this->addElement('select', 'eta',
            array(
                'label' => 'Data di nascita',
                'multiOptions' => $eta,
                'decorators' => $this->elementDecorators
                )
            );

//TELEFONO
        $this->addElement('text','telefono',
            array(
                'label' => 'Telefono',
                'filters' => array('StringTrim'),
                'validators' => array(array('StringLength', true, array(9, 15))), 
                'decorators' => $this->elementDecorators
                )
            );
//EMAIL
        $this->addElement('text','email',
            array(
                'label' => 'E-Mail',
                'validators' => array(array('StringLength', true, array(10, 30))),
                'decorators' => $this->elementDecorators
                )
            );
//INDIRIZZO
        $this->addElement('textarea', 'indirizzo',
            array(
                'label' => 'Indirizzo',
                'cols' => '30',
                'rows' => '3',
                'validators' => array(array('StringLength', true, array(10, 100))),
                'decorators' => $this->elementDecorators
                )
            );
//SUBMIT
        $this->addElement('submit', 'updatedata', 
            array(
                'label' => 'APPLICA',
                'decorators' => $this->buttonDecorators,
                )
            );
//DECORATORS
        $this->setDecorators(
            array(
                'FormElements',
                array('HtmlTag', array('tag' => 'table')),
                array('Description', array('placement' => 'prepend', 'class' => 'formerror')),
                'Form'
                )
            );
    }
}