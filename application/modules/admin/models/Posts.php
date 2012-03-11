<?php
class Admin_Model_Posts extends Zend_Db_Table
{
    protected $_name = "posts";
    protected $_rowClass = 'Admin_Model_Row_Tag';
    
    /**
     * Find all Posts 
     * 
     * @return array
     */
    public function findAll()
    {       
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('posts'), array('*'))
                       ->join('categories', 'posts.category = categories.id',array('cat_title','cat_url'))
                       ->join('users', 'posts.user = users.id','username')
                       ->order('date DESC');

        return $this->fetchAll($select);   
    }
    
    /**
     * Get post by id 
     * 
     * @param integer $id
     * @return array
     */
    public function getPostsById($id) 
    { 
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('posts'), array('*'))
                       ->join('categories', 'posts.category = categories.id',array('cat_url','cat_title'))
                       ->join('users', 'posts.user = users.id','username')    
                       ->where('category = ' . $id);
        
       return $this->fetchAll($select);
    }
    
    /**
     * Get posts by tag id
     * 
     * @param integer $tagId
     * @return array 
     */
    public function getPostsByTagId($tagId) 
    { 
      $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('tag_post'), array('*'))
                       ->join('posts', 'tag_post.post_id = posts.id')
                       ->join('categories', 'posts.category = categories.id',array('cat_url','cat_title'))
                       ->join('users', 'posts.user = users.id','username')    
                       ->where('tag_post.tag_id = '.$tagId);
      
       return $this->fetchAll($select);
    }
    
    /**
     *
     * @param integer $id
     * @return array
     * @throws Exception $id
     */
    public function getPostById($id) 
    { 
        $row = $this->fetchRow('id = '.$id);
        if (!$row) {
            throw new Zend_Controller_Action_Exception("Required param missed", 404);
        }
        
        return $row->toArray();     
    }
    
    /**
     *
     * @param string $url
     * @return array
     * @throws Exception $url
     */
    public function getPostByUrl($url) 
    { 
        $select = $this->select()
                        ->setIntegrityCheck(false)
                        ->from(array('posts'), array('*'))
                        ->join('categories', 'posts.category = categories.id','cat_title')
                        ->join('users', 'posts.user = users.id','username')    
                        ->where('url = "' . $url . '"');
        if (!$select) {
             throw new Zend_Controller_Action_Exception("Required param missed", 404);
        }

        return $this->fetchRow($select);
    }
    
    /**
     *Add post
     * 
     * @param string $title
     * @param string $full_text
     * @param string $url
     * @param bool $is_active
     * @param integer $category
     * @param integer $user
     * @param date $date 
     */
    public function addPost($title, $full_text, $url, $is_active, $category, $user, $date)
    {
        $data = array('title'=> $title,
                'full_text' => $full_text,
                'url' => $url,
                'is_active' => (bool)$is_active,
                'category' => $category,
                'user' => (int)$user,
                'date' => $date,); 
        $this->insert($data);
    }
    
    /**
     *Delete post
     * 
     * @param integer $id 
     */
    public function deletePost($id)
    {
        $this->delete('id =' . (int)$id);
    }
    
    /**
     * Update post
     * 
     * @param integer $id
     * @param string $title
     * @param string $full_text
     * @param string $url
     * @param bool $is_active
     * @param integer $category
     * @param date $date 
     */
    public function updatePost($id, $title, $full_text, $url, $is_active, $category, $date)
    {
       $data = array('id' => $id,
                'title'=> $title,
                'full_text' => $full_text,
                'url' => $url,
                'is_active' => $is_active,
                'category' => $category,
                'date' => $date,
                );
        $this->update($data, 'id =' . (int)$id );
    }
}