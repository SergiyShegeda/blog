<?php
class Admin_Model_Acl extends Zend_Acl 
{
    public function __construct() 
    {
        $this->addRole(new Zend_Acl_Role('guest'));
        $this->addRole(new Zend_Acl_Role('blogger'), 'guest');
        $this->addRole(new Zend_Acl_Role('admin'), 'blogger');

        $this->add(new Zend_Acl_Resource('posts'));
        $this->add(new Zend_Acl_Resource('comments'));

        $this->allow('guest', 'posts', 'view');
        $this->allow('blogger', 'comments', 'view');		
        $this->allow('blogger', 'comments', 'add');		
        $this->allow('blogger', 'posts', 'edit');
        $this->allow('blogger', 'posts', 'add');
    }
}