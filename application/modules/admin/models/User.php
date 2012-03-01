<?php
class Admin_Model_User extends Zend_Db_Table
{ 
    protected $_name = 'users';
    
    public function addUser($username, $password, $email, $role, $date_created )
    {   
       $data = array('username'=> $username,
                    'password' => sha1($password),
                    'email'=>$email,
                    'role'=>$role,
                    'date_created'=>$date_created,   
                    );
        $this->insert($data);
    }
}