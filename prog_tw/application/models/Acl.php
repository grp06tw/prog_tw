<?php 

class Application_Model_Acl extends Zend_Acl
{
	public function __construct()
	{
		// ACL for default role
		$this->addRole(new Zend_Acl_Role('pubblico'))
			 ->add(new Zend_Acl_Resource('public'))
			 ->add(new Zend_Acl_Resource('error'))
			 ->add(new Zend_Acl_Resource('index'))
			 ->allow('pubblico', array('public','error','index'));
			 
		// ACL for user
		$this->addRole(new Zend_Acl_Role('user'), 'pubblico')
			 ->add(new Zend_Acl_Resource('user'))
			 ->allow('user','user');
                
                // ACL for staff
		$this->addRole(new Zend_Acl_Role('staff'), 'pubblico')
			 ->add(new Zend_Acl_Resource('staff'))
			 ->allow('staff','staff');
				   
		// ACL for administrator
		$this->addRole(new Zend_Acl_Role('admin'), 'pubblico')
			 ->add(new Zend_Acl_Resource('admin'))
			 ->allow('admin','admin');
	}
        
        //getuser con la return e prende la risorsa utente e prende il metodo utente get utente che sta dentro
}