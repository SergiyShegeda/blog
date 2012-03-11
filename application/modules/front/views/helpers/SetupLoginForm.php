<?php
class Zend_View_Helper_SetupLoginForm
{
    public function SetupLoginForm() 
    {
        $loginForm = new Application_Form_Login();
        $loginForm->position->setValue('front');
  
        return  $loginForm;
    }
}