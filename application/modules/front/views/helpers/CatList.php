<?php
class Zend_View_Helper_CommentsCount
{
   public function CommentsCount($id) 
    {
      $cat = new Admin_Model_Cats();
      $cat = $cat->findAll();
    }
}