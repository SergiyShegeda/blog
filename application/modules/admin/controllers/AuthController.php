<?php
class Admin_AuthController extends Zend_Controller_Action
{
     /**
     *
     * @return \Zend_Auth_Adapter_DbTable 
     */
    protected function _getAuthAdapter() 
    {      
        $dbAdapter = Zend_Db_Table::getDefaultAdapter();
        $authAdapter = new Zend_Auth_Adapter_DbTable($dbAdapter);  
        $authAdapter->setTableName('users')
        ->setIdentityColumn('username')
        ->setCredentialColumn('password')
        ->setCredentialTreatment('SHA1(?)');       
        
        return $authAdapter;
    }
    
    /**
     * Check on the correctness of data entered by the user (username and pass.)
     * @param type $values
     * @return boolean 
     */
    protected function _process($values)
    {
        $adapter = $this->_getAuthAdapter();
        $adapter->setIdentity($values['username']); 
        $adapter->setCredential($values['password']);
        $auth = Zend_Auth::getInstance();
        $result = $auth->authenticate($adapter);
        if ($result->isValid()) {
            $user = $adapter->getResultRowObject();
            $auth->getStorage()->write($user);

            return true;
        }
        
    return false;
    }
   
    /**
     * 
     */
    public function indexAction()
    {
        $form = new Application_Form_Login();  
        $request = $this->getRequest();
        if ($request->isPost()) {
            if ($form->isValid($request->getPost())) {                               
                if ($this->_process($form->getValues())) {
                    if ($form->position->getValue() == 'front'){
                        $this->_helper->redirector('index', 'index','front');
                       
                     }
                    $this->_helper->redirector->setGotoRoute(array('controller'=>'index', 'action'=>'index'),'admin');
                }
               
             }
        }
        $this->view->form = $form;
    }
    
    /**
     * 
     */
    public function logoutAction()
    {
        Zend_Auth::getInstance()->clearIdentity();
        $this->_helper->redirector('index','index','front'); 
    }
}