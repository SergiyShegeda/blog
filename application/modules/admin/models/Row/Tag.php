<?php
class Admin_Model_Row_Tag extends Zend_Db_Table_Row
{
    /**
     * Get tags for post
     * 
     * @return array 
     */
    public function getTags() 
    {
        $select = $this->select()
                        ->setIntegrityCheck(false)
                        ->from(array('tag_post'), array('*'))
                        ->join('tags','tag_post.tag_id = tags.tag_id')
                        ->where('tag_post.post_id = ?', $this->id); 

        return $this->getTable()->fetchAll($select)->toArray(); 
    }

}
