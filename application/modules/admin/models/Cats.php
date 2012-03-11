<?php
class Admin_Model_Cats extends Zend_Db_Table
{
    protected $_name = "categories";
    
    /**
     * Find all Categories
     * 
     * @return array 
     */
    public function findAll()
    {
        $select = $this->select()
                       ->setIntegrityCheck(false)
                       ->from(array('categories'), array('*'));
              
        return $this->fetchAll($select);   
    }
    
    /**
     * Get categorie for id
     * 
     * @param integer $id
     * @return array
     * @throws Exception $id 
     */
    public function getCat($id) 
    { 
        $id = (int)$id;
        $row = $this->fetchRow('id = ' . $id);
        if (!$row) {
            throw new Zend_Controller_Action_Exception("Required param missed", 404);
        }
        
        return $row->toArray();
    }
    
    /**
     *
     * @param string $url
     * @return integer
     * @throws Exception $url 
     */
    public function getCatByUrl($url) 
    { 
        $row = $this->fetchRow('cat_url = "' . $url . '"');
        if (!$row) {
            throw new Zend_Controller_Action_Exception("Required param missed", 404);
        }
      
        return (int)$row->id;
    }

    /**
     * Update categorie
     * 
     * @param integer $id
     * @param string $url
     * @param string $title
     * @param integer $parent 
     */
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
    
    /**
     * Delete categorie
     * 
     * @param integer $id 
     */
    public function deleteCat($id)
    {
        $this->delete('id =' . (int)$id);
    }

    /**
     * Add categorie
     *
     * @param string $url
     * @param string $title
     * @param integer $parent 
     */
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