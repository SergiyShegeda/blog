<?php
class Front_PostController extends Zend_Controller_Action
{
    public function indexAction()
    {

    }
    
    /**
     * View a selected Post 
     */
    public function viewAction()
    {
        $post = $this->getRequest()->getParams();
        $url = $post['postUrl'];
        $post = new Admin_Model_Posts();
        $post = $post->getPostByUrl($url);
        $this->view->post = $post;
        $comments = new Admin_Model_Comments();
        $form = new Front_Form_Comments();
        if ($this->getRequest()->isPost()) {        
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {   
                $postId = $post['id']; 
                $description = $form->getValue('comment');
                $auth = Zend_Auth::getInstance();
                $name = $auth->getIdentity()->id;   
                $postedOn = date("y.m.d H:i:s");
                $comments->saveComment($postId,$description,$name,$postedOn);
            }
        }       
        $comments = new Admin_Model_Comments();
        $result = $comments->getCommentsById($post['id']);
        $page = $this->_getParam('page',1);
        $paginator = Zend_Paginator::factory($result);
        $paginator->setItemCountPerPage(5);
        $paginator->setCurrentPageNumber($page);
        $this->view->paginator = $paginator;               
        if(Zend_Auth::getInstance()->hasIdentity()) {
            $acl = new Admin_Model_Acl();
            $identity = Zend_Auth::getInstance()->getIdentity();
            if($acl->isAllowed( $identity->role,'comments','view') ) {
                $this->view->form  =  $this->view->addComments();
            }        
        }
    }
    
    /**
     * View all post by selected categorie 
     */
    public function postsByCatAction()
    {
        $cat = $this->getRequest()->getParams();  
        $catId = new Admin_Model_Cats();
        $catId = $catId->getCatByUrl($cat['catUrl']);
        $posts = new Admin_Model_Posts();
        $tagsList = new Admin_Model_Tags();
        $result = $posts->getPostsById($catId);  
        $page = $this->_getParam('page',1);
        $paginator = Zend_Paginator::factory($result);
        $paginator->setItemCountPerPage(5);
        $paginator->setCurrentPageNumber($page);
        $this->view->paginator = $paginator;
        $this->view->tags = $tagsList->findTags(); 
    }
    
    /**
     * View all post by selected Tag  
     */
    public function postsByTagAction()
    {
        $tag       = $this->getRequest()->getParams();  
        $tags  = new Admin_Model_Tags();
        $tagId = $tags->getTagById($tag['tag']);    
        $posts     = new Admin_Model_Posts();
        $result    = $posts->getPostsByTagId($tagId); 
        $page      = $this->_getParam('page',1);
        $paginator = Zend_Paginator::factory($result);
        $paginator->setItemCountPerPage(5);
        $paginator->setCurrentPageNumber($page);
        $this->view->paginator = $paginator;
        $this->view->tags = $tags->findTags(); 
    }
}

