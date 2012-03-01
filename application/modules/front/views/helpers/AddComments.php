<?php
class Zend_View_Helper_AddComments
{
   public function AddComments() 
    {
       $form = new Front_Form_Comments();
       
       return $form;
    }
}