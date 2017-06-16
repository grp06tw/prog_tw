<?php

class Zend_View_Helper_Ottieni extends Zend_View_Helper_Abstract {

    public function Ottieni($idPromo) {
        $this->_authService = new Application_Service_Auth();
        $datiUtente = $this->_authService->getIdentity();
        
        if (isset($datiUtente->role)) {
            $u = $datiUtente->role;

            if ($u == "user") {
                $idUtente = $datiUtente->ID_Utente;

                $urlaction = $this->view->url(array('controller' => 'user', 'action' => 'addcoupon', 'idPromo' => $idPromo, 'idUtente' => $idUtente));

                $form = '<form action="' . $urlaction . '"><input type="submit" value="Ottieni" id="submit_buy"></form>';
                return $form;
            } else {
                return 0;
            }
        }else {
            $urlaction=$this->view->url(array('controller' => 'public', 'action' => 'login'));
                $frase='<p class="faiLogin">Per acquisire un coupon: <a href="'.$urlaction.'">Login</a></p>';
                return $frase;
        }
    }

}
