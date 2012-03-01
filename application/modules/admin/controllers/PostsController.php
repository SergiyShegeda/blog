<?php

class Admin_PostsController extends Zend_Controller_Action
{
     /**
     * Check if user is logged on 
     */
    public function init()
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            $this->_helper->redirector('index','auth','admin');
        }
    }

    public function indexAction()
    {
        // action body
        $posts = new Admin_Model_Posts();
        $this->view->posts = $posts->findAll(); 
        $this->view->title = _("Posts");
        $tagsList = new Admin_Model_Tags();
        $this->view->tags = $tagsList->findTags();
       
    }
    public function addAction()
    {
        $form = new Admin_Form_Posts(); 
        $form->submit->setLabel('Add');
        $this->view->form = $form;     
        if ($this->getRequest()->isPost()) {        
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $title = $form->getValue('title'); 
                $full_text = $form->getValue('full_text');
                $url = $form->getValue('url');
                $is_active = $form->getValue('is_active');
                $tags = $form->getValue('tags');
                $tags = explode(',', $tags);
                $category = $form->getValue('parent_id'); 
                $auth = Zend_Auth::getInstance();  
                $post = new Admin_Model_Posts();
                $post->addPost($title, $full_text, $url, $is_active, $category, $auth->getIdentity()->id, date("y.m.d H:i:s"));  
                $post = new Admin_Model_Tags();
                $post->setTags($tags, $post->getAdapter()->lastInsertId('posts'));
                $this->_helper->redirector->setGotoRoute(array('controller'=>'posts', 'action'=>'index'),'admin');;
            } else {
                $form->populate($formData);
            }
        }
    }   

    public function editAction()
    {
        $form = new Admin_Form_Posts(); 
        $form->submit->setLabel('Add');
        $this->view->form = $form;       
        $id = $this->_getParam('id');
        if ($id > 0) {
            $post = new Admin_Model_Posts();
            $tagsList = new Admin_Model_Tags();
            $form->tags->setValue($tagsList->getTagsByPost($this->_getParam('id'),1));
            $form->populate($post->getPost($id));
        }
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $id = (int)$form->getValue('id');
                $title = $form->getValue('title'); 
                $full_text = $form->getValue('full_text');
                $tags = $form->getValue('tags');
                $tags = explode(',', $tags);    
                $url = $form->getValue('url');
                $is_active = $form->getValue('is_active');
                $category = $form->getValue('parent_id');
                $post = new Admin_Model_Posts();
                $post->updatePost($id, $title, $full_text, $url, $is_active, $category, date("y.m.d H:i:s"));                  
                $post = new Admin_Model_Tags();
                $post->delTags($this->_getParam('id'));
                $post->setTags($tags, $this->_getParam('id'));   
                $this->_helper->redirector->setGotoRoute(array('controller'=>'posts', 'action'=>'index'),'admin');
            } else {
                $form->populate($formData);
            }
        }
    }
}

