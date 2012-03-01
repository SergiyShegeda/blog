<?php
class LayoutLoader extends Zend_Controller_Action_Helper_Abstract
{
 public function preDispatch() 
    {
        $bootstrap = $this->getActionController()
                          ->getInvokeArg('bootstrap');
        $config = $bootstrap->getOptions();
                
        $module = $this->getRequest()->getModuleName();
        
        if (isset($config[$module]['resources']['layout']['layout'])) {
            $layoutScript = $config[$module]['resources']['layout']['layout'];
            $this->getActionController()
                 ->getHelper('layout')
                 ->setLayout($layoutScript);
        }
    }
}

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
   protected function _init()
   {
       Zend_Controller_Action_HelperBroker::addPath(
        APPLICATION_PATH .'/modules/admin/controllers/helpers');
   }
    protected function _initLayoutHelper()
    {
        $this->bootstrap('frontController');
        Zend_Controller_Action_HelperBroker::addHelper(new LayoutLoader());
    }
    public function _initRouter()
    {
    
        $front = Zend_Controller_Front::getInstance();
        $router = $front->getRouter();
        
        $router-> addRoute('postView',new Zend_Controller_Router_Route(
                ':catUrl/:postUrl/*',
                array(
                    'controller' => 'post',
                    'action'     => 'view'
                )
            )    
        );
        $router-> addRoute('catView',new Zend_Controller_Router_Route(
                ':catUrl',
                array(
                    'controller' => 'post',
                    'action'     => 'postsByCat'
                )
            )    
        );
        $router->addRoute('admin',new Zend_Controller_Router_Route(
            'aria77/:controller/:action/*',
                array(
                  'module' => 'admin',
                  'controller' => 'index',
                  'action'     => 'index'
                )
             )
        );
        
         $router->addRoute('reg',new Zend_Controller_Router_Route(
            '/registration',
                array(
                  'controller' => 'index',
                  'action'     => 'register'
                )
             )
        );
         $router->addRoute('logout',new Zend_Controller_Router_Route(
            '/log',
                array(
                  'module'=>'admin',
                  'controller' => 'auth',
                  'action'     => 'logout'
                )
             )
        );
         $router->addRoute('paginator',new Zend_Controller_Router_Route(
            ':page',
                array(
                  'module'=>'front',
                  'controller' => 'index',
                  'action'     => 'index',
                  'page' => 1
                ),
                  array(
                       'page' => '\d+'                     
                  )
             )
        );     
         
         return $router;
    }
 }

