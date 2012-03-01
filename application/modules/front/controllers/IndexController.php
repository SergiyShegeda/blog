<?php
class Front_IndexController extends Zend_Controller_Action
{
    public function init()
    {
    /* Initialize action controller here */
    }

    public function indexAction()
    {
        $posts = new Admin_Model_Posts();
        $tagsList = new Admin_Model_Tags();
        $result = $posts->findAll();   
        $page = $this->_getParam('page',1);
        $paginator = Zend_Paginator::factory($result);
        $paginator->setItemCountPerPage(5);
        $paginator->setCurrentPageNumber($page);
        $this->view->paginator = $paginator;
        $this->view->tags = $tagsList->findTags();                
    }

    /**
    * Register for new account
    */
    public function registerAction()
    {
        $form = new Application_Form_Registration();
        $form->submit->setLabel('Registration');
        $this->view->register = $form;       
        if ($this->getRequest()->isPost()) {
            $formData = $this->getRequest()->getPost();
            if ($form->isValid($formData)) {
                $username = $form->getValue('username');
                $email = $form->getValue('email');        
                $password = $form->getValue('password');
                $role = 'blogger';
                $date_created = date("y.m.d ");
                $user = new Admin_Model_User();
                $user->addUser($username, $password, $email, $role, $date_created );
            } 
        } 
        $this->view->title = 'Registration:';
    }

    /**
    * User submits for new password 
    */
    public function forgotPasswordAction()
    {
        $forgotPassword = new Application_Form_ForgotPassword();
        $this->view->forgotPassword = $forgotPassword;
    }
}