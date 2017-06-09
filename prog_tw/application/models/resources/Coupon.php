<?php

class Application_Resource_Coupon extends Zend_Db_Table_Abstract {

    protected $_name = 'coupon';
    protected $_primary = 'ID_Coupon';
    protected $_rowClass = 'Application_Resource_Coupon_Item';

    public function init() {
        
    }
    
    public function reach($iduser, $idpromo) {
        if($iduser == null)
        {
            //non puoi acquisire un coupon   
        }
        
        
        
        $this->insert($coupon);
            
    }
    
    public function insertPromo($promo) {
        if ($promo['immagine'] == null) {
            $promo['immagine'] = 'default.jpg';
        }
        $this->insert($promo);
    }

    public function getCoupon() {
        return $this->fetchAll($this->select());
    }

}
