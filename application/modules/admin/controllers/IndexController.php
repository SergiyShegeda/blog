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
            $this->_helper->redirector->setGotoRoute(array('controller'=>'auth', 'action'=>'index'),'admin');
        }
    }
    
    public function indexAction()
    {

    }
}

