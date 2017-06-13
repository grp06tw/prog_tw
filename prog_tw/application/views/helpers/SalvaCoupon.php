<?php

class Zend_View_Helper_SalvaCoupon extends Zend_View_Helper_Abstract {

    public function SalvaCoupon() {
        //helper per il bottone salva, riporta alla index, dovrebbe fare qualcos altro
            $urlaction = $this->view->url(array('controller' => 'user', 'action' => 'index'));
            $form = '<form action="' . $urlaction . '"><input type="submit" value="Salva" class="ottieni"></form>';
            return $form;
    }
}
