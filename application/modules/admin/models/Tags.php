<?php
class Admin_Model_Tags extends Zend_Db_Table
{
    protected $_name = 'tags';

    public function findTags()
    {        
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('tag_post'), array('*'))
                       ->join('tags','tag_post.tag_id = tags.tag_id','name')
                       ->join('posts','tag_post.post_id = posts.id'); 

        return $this->fetchAll($select);
    }
    
    public function getTagsByPost($id, $param)
    {        
        $select = $this->select()
                        ->setIntegrityCheck(false)
                        ->from(array('tag_post'), array('*'))
                        ->join('tags','tag_post.tag_id = tags.tag_id')
                        ->where('tag_post.post_id = ?', $id); 

        if(!$param) { 
            
            return $this->fetchAll($select); 
        } else {   
            foreach ($this->fetchAll($select) as $c){
                $tags .= $c->name.',';
                
            }
                
            return $tags; 
        }
    }

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
    
    public function delTags($postId)
    {
        $this->getAdapter()->delete('tag_post', 'post_id =' . (int)$postId);
    }
}

