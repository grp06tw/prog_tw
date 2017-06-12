<?php

class Application_Resource_Coupon extends Zend_Db_Table_Abstract {

    protected $_name = 'coupon';
    protected $_primary = 'ID_Coupon';
    protected $_rowClass = 'Application_Resource_Coupon_Item';

    public function init() {
        
    }
    
    public function insertCoupon($coupon) {
        $this->insert($coupon);
        return $coupon;
    }
    
    public function getCouponById($idUser, $idPromo) {
        $select = $this->select()
                ->where("ID_Utente = " . $idUser." and ID_Promozione = " . $idPromo);
        $q = $this->fetchAll($select);
        //qui abbiamo dovuto usare il foreach perchè non riuscivamo a trovare un modo per vedere se la query
        //dava come risultato dei dati o no, le variabili nella risposta sono private
        foreach ($q as $r)
        {
            return $r;
        }
        return 0;
    }
    
    public function getCoupon() {
        return $this->fetchAll($this->select());
    }

}
