<?php

class Application_Form_Registration extends Zend_Form
{
    public function __construct()
    {
        parent::__construct($options);
        $this->setName('Registration');
        $username = new Zend_Form_Element_Text('username');
        $username->setLabel('Your Name')
                 ->setRequired(true)
                 ->addFilter('StripTags')
                 ->addFilter('StringTrim');		
        
        $email = new Zend_Form_Element_Text('email');
        $email->setLabel('Email')
               ->setRequired(true)
               ->addFilter('StripTags')
               ->addFilter('StringTrim')
               ->addValidator('EmailAddress')
               ->setErrorMessages(array('messages' => 'Invalid Email'));      
        
        $emailAgain = new Zend_Form_Element_Text('emailAgain');
        $emailAgain->setLabel('Email Again')
                   ->setRequired(true)
                   ->addFilter('StripTags')
                   ->addFilter('StringTrim')
                   ->addValidator('EmailAddress')
                   ->addValidators(array(array('identical', true, array('email'))))
                   ->addErrorMessage('Email do not Match');		
        
        $password = new Zend_Form_Element_Password('password');
        $password->setLabel('Password')
                 ->setRequired(true)
                 ->addFilter('StripTags')
                 ->addFilter('StringTrim')
                 ->addValidator('NotEmpty');    
        
        $passwordAgain = new Zend_Form_Element_Password('passwordAgain');
        $passwordAgain->setLabel('Password Again')
                      ->setRequired(true)
                      ->addFilter('StripTags')
                      ->addFilter('StringTrim')
                      ->addValidators(array(array('identical', true, array('password'))))
                      ->addErrorMessage('Password do not Match');
        
        $capcha = new Zend_Form_Element_Captcha('foo', array(
                                                'label' => "Please verify you're a human",
                                                'captcha' => array(
                                                'captcha' => 'Figlet',
                                                'wordLen' => 6,
                                                'timeout' => 300,),));
        
        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttrib('id', 'submitbutton');
        
        $this->addElements(array($username, $email, $emailAgain, $password, 
                                    $passwordAgain, $capcha, $submit));
    }
}