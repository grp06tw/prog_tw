<?php

class Application_Resource_Utente extends Zend_Db_Table_Abstract
{
    protected $_name    = 'utente'; 
    protected $_primary  = 'ID_Utente';    
    protected $_rowClass = 'Application_Resource_Utente_Item'; 
    
	public function init()
    {
    }
    
    
    public function getUsers($where = null, $order = null)
    {
        if($where){
    	return $this->fetchAll($this->select()->where('role = "'.$where.'"')->order($order));
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
      
    //UPDATE
    public function upUser($user)
    {
	$this->update($user, "ID_Utente = ".$user["ID_Utente"]);
    }
    
    //DELETE
    public function deleteUser($id)
    {
        $this->delete("ID_Utente = ".$id);
    }
}

