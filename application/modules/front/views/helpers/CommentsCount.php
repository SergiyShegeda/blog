<?php
class Zend_View_Helper_CommentsCount
{
   public function CommentsCount($id) 
    {
        $commetns = new Admin_Model_Comments();
        
        return count($commetns->getCommentsById($id));
    }
}