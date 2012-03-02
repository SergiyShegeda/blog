<?php
class Admin_Bootstrap extends Zend_Application_Module_Bootstrap
{
    protected function _init()
    {
        Zend_Controller_Action_HelperBroker::addPath(
        APPLICATION_PATH .'/modules/admin/controllers/helpers');
    }
    protected function _initAutoload()
    {
        $autoloader = new Zend_Application_Module_Autoloader(array(
            'namespace' => 'Admin_',
            'basePath' => dirname(__FILE__)
        ));
        
        return $autoloader;
    }

    protected function _initViewHelpers()
    {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();
        $view->doctype('XHTML1_STRICT');
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8');
    }	
	
    protected function _initNavigation()
    {
        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();		
        $pages = array(
                    array(
                    'controller' => 'index',
                    'action' => 'index',
                    'label'         => _('Main'),
                    'pages' => array(
                                array(
                                'module' => 'admin',
                                'controller' => 'Auth',
                                'action' => 'logout',
                                'label'         => _('LogOut'),
                                )
                               )       
                    ),
                    array(      
                    'controller' => 'cat',
                    'action'     => 'index',
                    'module'     => 'admin',
                    'label'      => _('Cats'),
                    'pages' => array(    
                                array(
                                'controller' => 'cat',
                                'action'     => 'add',
                                'module'     => 'admin',
                                'label'      => _('cat_add'),
                                ),
                               )
                    ),
                    array(      
                    'controller' => 'posts',
                    'action'     => 'index',
                    'module'     => 'admin',
                    'label'      => _('Posts'),
                    'pages' => array(    
                                array(
                                'controller' => 'posts',
                                'action'        => 'add',
                                'module'        => 'admin',
                                'label'         => _('Post Add'),
                                ),
                               )
                    ),
                    array(      
                    'controller' => 'comments',
                    'action'        => 'index',
                    'module'        => 'admin',
                    'label'         => _('Comments'),
                    'pages' => array(    
                                array(
                                'controller' => 'posts',
                                'action'        => 'add',
                                'module'        => 'admin',
                                'label'         => _('Post Add'),
                                ),
                               )
                    ),
        );
        $container = new Zend_Navigation($pages);
        $view->navigation($container);
    }
}