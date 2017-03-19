<?php

class Application_Form_AddExperience extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');

        $title= new Zend_Form_Element_Text('title');
        $title->setLabel('Title :');
        $title->setAttribs(array('class'=>'form-control'));
        $title->setRequired();

        $description= new Zend_Form_Element_Text('description');
        $description->setLabel('Description :');
        $description->setAttribs(array('class'=>'form-control'));
        $description->setRequired();

        $image = new Zend_Form_Element_File('image');
        $image->setLabel('Upload an image:');
        $image->addValidator('Count', false, 1);
        $image->addValidator('Extension',false, 'jpg,jpeg,png,gif');


        $submit=new Zend_Form_Element_Submit('Submit');
        $submit->setAttribs(array(
          'class'=>'btn btn-success'
        ));

        $this->addElements(array(
          $title,
          $description,
          $image,
          $submit,
        ));
    }


}
