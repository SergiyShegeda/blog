<?php

class Admin_CommentsController extends Zend_Controller_Action
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
        $comments = new Admin_Model_Comments();
        $this->view->comments = $comments->getComments();
    }
   
    public function addAction()
    {  
        $form = new Application_Form_Comments();  
        $form->submit->setLabel('Add');
        $this->view->form = $form;       
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $url = $form->getValue('url');
                $title = $form->getValue('title');
                $parent = $form->getValue('parent_id'); 
                $cat = new Admin_Model_Cats();
                $this->_helper->redirector('index','cat');
            } 
        }
    }
}

