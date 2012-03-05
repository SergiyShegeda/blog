<?php

class Admin_CatController extends Zend_Controller_Action
{
    /**
     * Check for user logged on 
     */
    public function init()
    {
        $auth = Zend_Auth::getInstance();
        if (!$auth->hasIdentity()) {
            //redirect to login page
            $this->_helper->redirector('index', 'auth', 'admin');
        }
    }
    
    /**
     * Default Action 
     */
    public function indexAction()
    {
        $cat = new Admin_Model_Cats();
        $this->view->cat = $cat->findAll();
    }
    
    /**
     * Edit categorie
     */
    public function editAction()
    {
        $form = new Admin_Form_Cat();
        $form->submit->setLabel('Save');
        $this->view->form = $form;       
        $id = $this->_getParam('id', 0);
        
        if (!$id) {
            // redirect to 404 page
        }
        
        $news = new Admin_Model_Cats();
        $form->populate($news->getCat($id));
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            
            if ($form->isValid($formData)) {
                $id = (int) $form->getValue('id');
                
                if ($url) {
                    $url = $form->getValue('cat_url');
                } else {
                    $url = $this->_helper->UrlConverter($form->getValue('cat_title'));
                }
                
                $title = $form->getValue('cat_title');
                $parent = $form->getValue('parent_id');         
                $cat = new Admin_Model_Cats();
                $cat->updateCat($id, $url, $title, $parent);                
                
                $this->_helper->redirector->setGotoRoute(array('controller'=>'cat', 'action'=>'index'), 'admin');
            } else {
                $form->populate($formData);
            }
        }
    }
    
    /**
     * Delete Categorie 
     */
    public function deleteAction()
    {  
        $id = $this->_getParam('id');
        $cat = new Admin_Model_Cats();
        $cat->deleteCat($id);
        
        $this->_helper->redirector('index', 'cat');
    }
    
    /**
     * Add Categorie 
     */
    public function addAction()
    {  
        $form = new Admin_Form_Cat();
        $form->submit->setLabel('Add');
        $this->view->form = $form;   
        
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            
            if ($form->isValid($formData)) {
                
                if ($url) {
                    $url = $form->getValue('cat_url');
                } else {
                    $url = $this->_helper->UrlConverter($form->getValue('cat_title'));
                }
                
                $title = $form->getValue('cat_title');
                $parent = $form->getValue('parent_id');            
                $cat = new Admin_Model_Cats();
                $cat->addCat($url, $title, $parent);
                $this->_helper->redirector->setGotoRoute(array('controller'=>'cat', 'action'=>'index'), 'admin');
            } 
        }
    }
}
