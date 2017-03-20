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

        $photo = new Zend_Form_Element_File('photo');
        $photo->setLabel('Upload an image:');
        $photo->addValidator('Count', false, 1);
        $photo->addValidator('Extension',false, 'jpg,jpeg,png,gif');



        $city_obj = new Application_Model_City();
        $allCities = $city_obj->listCity();

        $city_id = new Zend_Form_Element_Select('city_id');
        $city_id->setLabel('City : ');

        foreach($allCities as $key=>$value)
        {
            $city_id->addMultiOption($value['id'], $value['city_name']);
        }


        // $user_obj = new Application_Model_User();
        // $allUsers = $user_obj->addNewUser();

        // $user_id = new Zend_Form_Element_Select('user_id');
        // $user_id->setLabel('User : ');

        // foreach($allUsers as $key=>$value)
        // {
        //     $user_id->addMultiOption($value['id'], $value['city_name']);
        // }


        $submit=new Zend_Form_Element_Submit('Submit');
        $submit->setAttribs(array(
          'class'=>'btn btn-success'
        ));

        $this->addElements(array(
          $title,
          $description,
          $photo,$city_id,
          $submit
        ));
    }


}