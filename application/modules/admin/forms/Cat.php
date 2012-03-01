<?php
class Admin_Form_Cat extends Zend_Form
{
    public function init()
    {
        $this->setName('Cat'); 
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');
        
        $url = new Zend_Form_Element_Text('cat_url');
        $url->setLabel('Url') 
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $title = new Zend_Form_Element_Text('cat_title');
        $title->setLabel('Title')
              ->setRequired(true)
              ->addFilter('StripTags')
              ->addFilter('StringTrim')
              ->addValidator('NotEmpty');
        
        $parent = new Zend_Form_Element_Select('parent_id'); 
        $add_parent = new Admin_Model_Cats();
        foreach ($add_parent->fetchAll() as $c) 
        {
            $parent->addMultiOption($c->id, $c->cat_title);     
        }
              
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $title,$url,$parent, $submit));
    }
}

