<?php

class Application_Form_ForgotPassword extends Zend_Form
{
    public function __construct()
    {
        parent::__construct($options);
        $this->setName('ForgotPassword');
        
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')
                ->setRequired(true)
                ->addFilter('StripTags')
                ->addFilter('StringTrim')
                ->addValidator('NotEmpty');
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        
        $this->addElements( array ($email, $submit));
    }
}

