<?php
class Front_Form_Comments extends Zend_Form
{
    public function init()
    {
        $this->setName("comments");
        $this->setMethod('post');     
        $this->setName('Comments');

        $id = new Zend_Form_Element_Hidden('id');
        
        $comment = new Zend_Form_Element_Textarea('comment');
        $comment->setLabel('Comments')
                ->setRequired(true)
                ->setAttrib('rows',7)
                ->setAttrib('cols',30)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        
        $this->addElements(array($id, $comment, $submit));                  
    }	
}