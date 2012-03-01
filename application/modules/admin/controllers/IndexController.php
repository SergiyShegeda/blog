<?php
class Admin_IndexController extends Zend_Controller_Action
{
     /**
     * Check if user is logged on 
     */
    public function init()
    { 
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            $this->_helper->redirector('index','auth','aria77');
        }
    }
    
    public function indexAction()
    {

    }
}

