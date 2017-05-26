<?php
class Application_Form_Staff_Promo_Add extends App_Form_Abstract
{
	protected $_staffModel;
        protected $_promo;
        public function __construct($options = null) {
            parent::__construct($options);
            
            if($options){
                    $app = $this->_staffModel->getPromoById($options);
                    $this->_promo=array("ID_Promozione" => $app->ID_Promozione,
                                        "titolo" => $app->titolo,
                                        "prezzo" => $app->prezzo,
                                        "sconto" => $app->sconto,
                                        "inizio" => $app->inizio,
                                        "fine" => $app->fine,
                                        "descrizione" => $app->descrizione,
                                        "immagine" => $app->immagine,
                                        "ID_Categoria" => $app->ID_Categoria,
                                        "ID_Azienda" => $app->ID_Azienda,);
                    
                    $this->init();
            }
            
        }

        public function init()
	{                
            
		$this->_staffModel = new Application_Model_Staff();
		$this->setMethod('post');
		$this->setName('addpromo');
		$this->setAction('');
		$this->setAttrib('enctype', 'multipart/form-data');
               
                
            //ID  -> Serve per la update
                $this->addElement('hidden', 'ID_Promozione', array(
                                    'filters' => array('StringTrim'),
                                    'show' => 'none',
                                    'decorators' => $this->elementDecorators,
                                    'value' => $this->_promo["ID_Promozione"]
		));
                
                
//TITOLO
		$this->addElement('text', 'titolo', array(
                                    'label' => 'Titolo',
                                    'filters' => array('StringTrim'),
                                    'required' => true,
                                    'validators' => array(array('StringLength',true, array(1,30))),
                                    'decorators' => $this->elementDecorators,
                                    'value' => $this->_promo["titolo"]
		));
//PREZZO
                $this->addElement('text', 'prezzo', array(
                                    'label' => 'Prezzo',
                                    'required' => true,
                                    'filters' => array('LocalizedToNormalized'),
                                    'validators' => array(array('Float', true, array('locale' => 'en_US'))),
                                    'decorators' => $this->elementDecorators,
                                    'value' => $this->_promo["prezzo"]
		));
//SCONTO
                $this->addElement('text', 'sconto',array(
                                    'label' => 'Sconto (%)',
                                    'value' => 0,
                                    'required' => true,
                                    'validators' => array('Int'),
                                    'decorators' => $this->elementDecorators,
                                    'value' => $this->_promo["sconto"]
		));
//INIZIO
             /*    $this->addElement('date', 'inizio',array(
                                    'label' => 'Data Inizio',
                                    'required' => true,
                                    'value' => '2017-06-01'
                                    'value' => $this->_promo["inizio"]
                                     
                                    
		));
//FINE
                 $this->addElement('date', 'inizio',array(
                                    'label' => 'Data Inizio',
                                    'required' => true,
                                    'min' => $this->inizio->value
                                    'value' => $this->_promo["fine"]
		));*/
//DESCRIZIONE
                $this->addElement('textarea', 'descrizione', array(
                                    'label' => 'Descrizione',
                                    'cols' => '60', 'rows' => '20',
                                    'filters' => array('StringTrim'),
                                    'required' => true,
                                    'validators' => array(array('StringLength',true, array(1,2500))),
                                    'decorators' => $this->elementDecorators,
                                    'value' => $this->_promo["descrizione"]
		));
//IMMAGINE                
                $this->addElement('file', 'immagine', array(
                                    'label' => 'Immagine corrente: ' . $this->_promo["immagine"],
                                    'destination' => APPLICATION_PATH . '/../public/img/promo',
                                    'validators' => array( 
                                        array('Count', false, 1),
                                        array('Size', false, 1048576),
                                        array('Extension', false, array('jpg', 'gif'))),
                                    'decorators' => $this->fileDecorators,
                                    'placeholder' => APPLICATION_PATH . '/../public/img/promo'. $this->_promo["immagine"],
                                    'value' => APPLICATION_PATH . '/../public/img/promo'. $this->_promo["immagine"],
			));
                
//CATEGORIA                
		$categories = array();
		$cats = $this->_staffModel->getCats();
		foreach ($cats as $cat) {
			$categories[$cat -> ID_Categoria] = $cat->nome;
		}
		$this->addElement('select', 'ID_categoria', array(
                                    'label' => 'Categoria',
                                    'required' => true,
                                    'multiOptions' => $categories,
                                    'decorators' => $this->elementDecorators,
                                    'value' => $this->_promo["ID_Categoria"]
		));

//AZIENDA 		

		$aziende = array();
		$az = $this->_staffModel->getAziende();
		foreach ($az as $azienda) {
			$aziende[$azienda -> ID_Azienda] = $azienda->nome;
		}
		$this->addElement('select', 'ID_Azienda', array(
                                    'label' => 'Azienda',
                                    'required' => true,
                                    'multiOptions' => $aziende,
                                    'decorators' => $this->elementDecorators,
                                    'value' => $this->_promo["ID_Azienda"]
                       
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