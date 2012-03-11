<?php
class Zend_View_Helper_TagCloud extends Zend_View_Helper_Abstract
{
    public function TagCloud()
    {
        $tags = new Admin_Model_Tags();
        $tags = $tags->getTagCloud();
        foreach ($tags as $key => $tag)
        {
          $tags[$key] += $tag + array(
              'params'=>array(
                  'url'=> $this->view->url(array('tag' => $tag['title']), 'tagView')
          ));  
        }
        
        $cloud = new Zend_Tag_Cloud(array('tags' => $tags));
        
        return $cloud;
    }
}