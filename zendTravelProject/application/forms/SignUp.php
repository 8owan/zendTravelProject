<?php

class Application_Form_SignUp extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');

        $user_name = new Zend_Form_Element_Text('user_name');
        $user_name->setLabel('Enter Your Name: ');
        $user_name->setAttribs(Array(
          'placeholder' => 'Example: Mohamed',
          'class' => 'form-control'
        ));
        $user_name->setRequired();


        $email=new Zend_Form_Element_Text('email');
        $email->setLabel("E-mail : ");
        $email->setAttribs(array(
          'placeholder' => 'Example: Ali@yahoo.com',
          'class'=>'form-control'
        ));
        $email->addValidator('EmailAddress',TRUE);
        $email->setRequired();


        $password=new Zend_Form_Element_Password('password');
        $password->setLabel("Password : ");
        $password->setAttribs(array(
          'class'=>'form-control'
        ));
        $password->setRequired();

        $confirm = new Zend_Form_Element_Password('confirm');
        $confirm->setLabel('Retype-Password: ');
        $confirm->setAttribs(Array(
            'class' => 'form-control'
        ));
        $v = new Zend_Validate_Identical("password");
        $confirm->addValidator($v);

        $image = new Zend_Form_Element_File('image');
        $image->setLabel('Upload an image:');
        $image->addValidator('Count', false, 1);
        $image->addValidator('Extension',false, 'jpg,jpeg,png,gif');


        $submit=new Zend_Form_Element_Submit('Submit');
        $submit->setAttribs(array(
          'class'=>'btn btn-success'
        ));

        $reset=new Zend_Form_Element_Reset('Reset');
        $reset->setAttribs(array(
          'class'=>'btn btn-danger'
        ));

        $this->addElements(array(
          $user_name,
          $email,
          $password,
          $confirm,
          $image,
          $submit,
          $reset
        ));
    }


}
