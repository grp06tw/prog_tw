<?php

class Application_Resource_Utente extends Zend_Db_Table_Abstract
{
    protected $_name    = 'utente'; 
    protected $_primary  = 'ID_Utente';    
    protected $_rowClass = 'Application_Resource_Utente_Item'; 
    
	public function init()
    {
    }
    
    
    public function getUsers($where = null)
    {
        if($where){
    	return $this->fetchAll($this->select()->where('role = "staff"'));
        }
        else{
            return $this->fetchAll($this->select());
        }
    }
    
    public function getUserById($id)
    {
    	return $this->find($id)->current();
    }
    

    public function getUserLogin($usrName)
    {
        return $this->fetchRow($this->select()->where('Username = ?', $usrName));
        //select -> where id_utente
                
    }	
    
    //INSERT
    public function insertUser($user)
    {
    	$this->insert($user);
    }
    
    /*DELETE
    public function delPromo($promo)
    {
        $this->delete("ID_Promozione = ".$promo["ID_Promozione"]);
    }
    //UPDATE
    public function updatePromo($promo)
    {
	$this->update($promo, "ID_Promozione = ".$promo["ID_Promozione"]);
    }*/
}

