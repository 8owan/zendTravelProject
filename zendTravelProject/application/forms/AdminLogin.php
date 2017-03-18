<?php

class Application_Form_AdminLogin extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('post');

        $email=new Zend_Form_Element_Text('email');
        $email->setLabel("E-mail : ");
        $email->setAttribs(array(
          'class'=>'form-control'
        ));
        $email->setRequired();


        $password=new Zend_Form_Element_Password('password');
        $password->setLabel("Password : ");
        $password->setAttribs(array(
          'class'=>'form-control'
        ));
        $password->setRequired();

        $submit=new Zend_Form_Element_Submit('Submit');
        $submit->setAttribs(array(
          'class'=>'btn btn-success'
        ));

        $this->addElements(array(
          $email,
          $password,
          $submit
        ));


    }


}
