<?php

/**
 * This file looks like just a FUCKED!!!! WTF! CLEAN IT PLEASE!
 */
class Bootstrap extends Zend_Application_Bootstrap_Bootstrap

{   /**
     * Init Action hellpers
     */
    protected function _initActionHelper()
    {
        Zend_Controller_Action_HelperBroker::addHelper(new Blog_Action_Helper_UrlConverter());
    }
    
    /**
     * Init Layout helpers
     */
    protected function _initLayoutHelper()
    {
        $this->bootstrap('frontController');
        Zend_Controller_Action_HelperBroker::addHelper(new Blog_Action_Helper_LayoutLoader());
    }
    
    /**
     * Init routes
     *
     */
    public function _initRouter()
    {
        $front = Zend_Controller_Front::getInstance();
        $router = $front->getRouter();
        
        //route for view post
        $router-> addRoute('postView',new Zend_Controller_Router_Route(
            ':catUrl/:postUrl/*', array(
                'controller' => 'post',
                'action'     => 'view'
            )
        ));
        
        // route for the categorie
        $router-> addRoute('catView',new Zend_Controller_Router_Route(
            ':catUrl', array(
                'controller' => 'post',
                'action'     => 'posts-By-Cat'
            )
        ));
        
        //route for tags
        $router-> addRoute('tagView', new Zend_Controller_Router_Route(
                '/tag/:tag', array(
                'module' => 'front',
                'controller' => 'post',
                'action' => ' posts-By-Tag'    
                )
        ));
        
        //route rules for the homepage
        $router->addRoute('homepage', new Zend_Controller_Router_Route(
                '', array(
                'module' => 'front',
                'controller' => 'index',
                'action'     => 'index'
                )
        ));
        
        //route for the admin side
        $router->addRoute('admin',new Zend_Controller_Router_Route(
            'aria77/:controller/:action/*', array(
                'module' => 'admin',
                'controller' => 'index',
                'action'     => 'index'
            )
        ));
        
        //route for registration page
        $router->addRoute('registration',new Zend_Controller_Router_Route(
            '/registration',array(
                'controller' => 'index',
                'action'     => 'register'
            )
        ));
        
        //logout route
        $router->addRoute('logout',new Zend_Controller_Router_Route(
            '/logout', array(
                'module'=>'admin',
                'controller' => 'Auth',
                'action'     => 'logout'
            )
        ));
        
        //route for paginator
        $router->addRoute('paginator',new Zend_Controller_Router_Route(
            ':page',array(
                'module'=>'front',
                'controller' => 'index',
                'action'     => 'index',
                'page' => 1
            ),
                array(
                    'page' => '\d+'                     
                )
        ));     
         
     return $router;
    }
}



