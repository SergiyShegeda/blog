<?php
class Admin_Model_Tags extends Zend_Db_Table
{
    protected $_name = 'tags';

    /**
     *Find all tags
     * 
     * @return array 
     */
    public function findTags()
    {        
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('tag_post'), array('*'))
                       ->join('tags','tag_post.tag_id = tags.tag_id','name')
                       ->join('posts','tag_post.post_id = posts.id'); 

        return $this->fetchAll($select);
    }
    
    /**
     * Get tags for tag cloud 
     * 
     * @return array 
     */
    public function getTagCloud()         
    {
        $select = $this->select()
                        ->setIntegrityCheck(false)
                        ->from(array('tag_post'), array('COUNT(tag_post.tag_id) AS weight',))
                        ->join('tags','tag_post.tag_id = tags.tag_id','name AS title')
                        ->group('tags.tag_id');
                        
        return $this->fetchAll($select)->toArray(); 
    }
    
    /**
     *
     * @param string $tagTitle
     * @return intger
     * @throws Exception $tagTitle
     */
    public function getTagById($tagTitle)
    {
       $row = $this->fetchRow('name = "' . $tagTitle . '"');
       if (!$row) 
       {
            throw new Zend_Controller_Action_Exception("Required param missed", 404);
       }
      
        return (int)$row->tag_id;
    }
    
    /**
     * Set tags for current post 
     * 
     * @param array $array
     * @param integer $postId     
     */
    public function setTags($array, $postId)           
    {
        $dbTags = $this->fetchAll()->toArray();    
        foreach ($array as $tag){
            $tag = trim($tag);
            if($tag){
                $where = $this->getAdapter()->quoteInto('name = ?', $tag);
                $result = $this->fetchAll($where, $this->name)->toArray();  

                if(count($result)){       
                    $this->getAdapter()->insert('tag_post',array('post_id'=>$postId,
                                                                 'tag_id'=>$result[0]['tag_id']
                                                                ));
                }else{ 
                $this->insert(array('name'=>$tag));
                $this->getAdapter()->insert('tag_post',array('post_id'=>$postId,
                                                             'tag_id'=>$this->getAdapter()->lastInsertId('tags')
                                                            ));
                }
            }
        }
    }
    
    /**
     *Delete tags
     * 
     * @param integer $postId 
     */
    public function delTags($postId)
    {
        $this->getAdapter()->delete('tag_post', 'post_id =' . (int)$postId);
    }
}

