<?php
class Admin_Model_Comments extends Zend_Db_Table
{
    protected $_name = 'comments';
    
    /**
     *Get all comments
     * 
     * @return array 
     */
    public function getComments() 
    {
        $result = $this->fetchAll();
        
        return $result->toArray();
    }
    
    /**
     *Get comments by id
     * 
     * @param integer $id
     * @return array 
     */
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
    
    /**
     * Save comment
     * 
     * @param integer $postId
     * @param string $description
     * @param string $name
     * @param date $postedOn 
     */
    public function saveComment($postId, $description, $name, $postedOn)
    {
        $data = array('post_id' => $postId,
                    'Description' => $description,
                    'Name' => $name,
                    'Postedon' => $postedOn);				
        $this->insert($data);
    }
}