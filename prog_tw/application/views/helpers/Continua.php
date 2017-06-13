<?php

class Zend_View_Helper_Continua extends Zend_View_Helper_Abstract {

    public function Continua() {
            $urlaction = $this->view->url(array('controller' => 'public', 'action' => 'promo'));

            $form = '<form action="' . $urlaction . '"><input type="submit" value="Continua Navigazione" class="ottieni"></form>';
            return $form;
    }

}
