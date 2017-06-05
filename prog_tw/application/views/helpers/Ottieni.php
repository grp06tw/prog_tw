<?php
class Zend_View_Helper_Ottieni extends Zend_View_Helper_Abstract
{
	public function Ottieni($reachForm)
	{
            $this->_authService = new Application_Service_Auth();
            
            if (isset($this->_authService->getIdentity()->role)) {
            return $reachForm;
        }
    }
}
