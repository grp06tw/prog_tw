<?php

abstract class App_Model_Abstract
{	
	protected $_resources = array();
	
        //aggiunge la risorsa(controller(?)) e rinomina il percorso, deve comporre il nome della classe
	public function getResource($name) 
	{
		if (!isset($this->_resources[$name])) {
                    $class = implode('_', array(
                    $this->_getNamespace(),
                    'Resource',
                    $name));                    
            $this->_resources[$name] = new $class();
        }
	    return $this->_resources[$name];
	}

	private function _getNamespace()
    {
        $ns = explode('_', get_class($this));
        return $ns[0];
    }

}