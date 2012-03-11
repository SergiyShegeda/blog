<?php
class Admin_Form_Posts extends Zend_Form
{
    public function init()
    {
        $this->setName('Post'); 
        $id = new Zend_Form_Element_Hidden('id');
        $id->addFilter('Int');

        $title = new Zend_Form_Element_Text('title');
        $title->setLabel('Title')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('NotEmpty');

        $full_text = new Zend_Form_Element_Textarea('full_text');
        $full_text->setLabel('Text')
                   ->setRequired(false);

        $url = new Zend_Form_Element_Text('url');
        $url->setLabel('url') 
            ->addFilter('StripTags')
            ->addFilter('StringTrim')
            ->addValidator('NotEmpty');

        $is_active = new Zend_Form_Element_Radio('is_active');
        $is_active->setLabel('Active?:')
                   ->setRequired(true)
                   ->addMultiOptions(array(
                                    '1' => 'Active',
                                    '0' => 'Unactive'
                                    ))
                   ->setSeparator('');

        $parent = new Zend_Form_Element_Select('parent_id'); 
        $add_parent = new Admin_Model_Cats();
        foreach ($add_parent->findAll() as $c) 
        {
            $parent->addMultiOption($c->id, $c->cat_title);     
        }

        $tags = new Zend_Form_Element_Text('tags');  
        $tags->setLabel('Tags') 
             ->addFilter('StripTags')
             ->addFilter('StringTrim')
             ->addValidator('NotEmpty');

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');

        $this->addElements(array($id, $title, $full_text, $url, $tags, $is_active, $parent, $submit));
    }
}

