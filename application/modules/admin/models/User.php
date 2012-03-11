<?php
class Admin_Model_User extends Zend_Db_Table
{ 
    protected $_name = 'users';
    
    /**
     *Add new user 
     * 
     * @param string $username
     * @param hash $password
     * @param string $email
     * @param string $role
     * @param date $date_created 
     */
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