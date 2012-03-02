<?php
class Admin_Model_Comments extends Zend_Db_Table
{
    protected $_name = 'comments';

    public function getComments() 
    {
        $result = $this->fetchAll();
        
        return $result->toArray();
    }
    
    public function getCommentsById($id) 
    {     
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('comments'), array('*'))
                       ->join('users', 'comments.Name = users.id','username')
                       ->where('post_id = ' . $id)         
                       ->order('Postedon DESC');
        
        return $this->fetchAll($select);
    }

    public function saveComment($postId, $description, $name, $postedOn)
    {
        $data = array('post_id' => $postId,
                    'Description' => $description,
                    'Name' => $name,
                    'Postedon' => $postedOn);				
        $this->insert($data);
    }
}