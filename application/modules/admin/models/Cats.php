<?php
 
class Admin_Model_Cats extends Zend_Db_Table
{
    protected $_name = "categories";

    public function findAll()
    {
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('categories'), array('*'));

        return $this->fetchAll($select);   
    }

    public function getCat($id) 
    { 
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Exception("Could not find row $id");
        }
        
        return $row->toArray();
    }
    
    public function getCatByUrl($url) 
    { 
        $row = $this->fetchRow('cat_url = "' . $url . '"');
        if (!$row) {
            throw new Exception("Could not find row ");
        }
      
        return (int)$row->id;
    }

    public function updateCat($id, $url, $title, $parent)
    {
        $data = array(
                'id' => $id,
                'cat_url'=> $url,
                'cat_title' => $title,
                'parent_id'=>$parent,
                );
        $this->update($data, 'id = '. (int)$id);
    }

    public function deleteCat($id)
    {
        $this->delete('id =' . (int)$id);
    }

    public function addCat($url, $title, $parent)
    {
        $data = array(
                'cat_url'=> $url,
                'cat_title' => $title,
                'parent_id'=>$parent,
                );
        $this->insert($data);
    }
}