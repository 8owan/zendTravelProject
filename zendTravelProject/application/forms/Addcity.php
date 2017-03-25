<?php

class Application_Form_Addcity extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */


        $this->setMethod('POST');
        // $id = new Zend_Form_Element_Hidden('id');
        /* Form Elements & Other Definitions Here ... */
        $city_name= new Zend_Form_Element_Text('city_name');
        $city_name->setLabel('City Name :');
        $city_name->setAttribs(array('placeholder'=>'city Name','class'=>'form-control'));
        $city_name->setRequired();

      

        $photo = new Zend_Form_Element_File('photo');
        $photo->setLabel('Upload an image:');
        $photo->addValidator('Count', false, 1);
        $photo->addValidator('Extension',false, 'jpg,jpeg,png,gif');

         $description=new Zend_Form_Element_Text('description');
        $description->setLabel('Description :');
        $description->setAttribs(array('placeholder'=>'Description','class'=>'form-control'));
        $description->setRequired();


        $country_obj= new Application_Model_Country();
        $allCountries = $country_obj->allCountries();
        $country_id= new Zend_Form_Element_Select('country_id');

         $country_id->setLabel('Country Name :');


foreach($allCountries as $key=>$value)
    {
      $country_id->addMultiOption($value['id'], $value['country_name']);
    }


$submit=new Zend_Form_Element_Submit('submit');
        $submit->setAttribs(array('class'=>'btn btn-success'));


$reset=new Zend_Form_Element_Reset('reset');
        $reset->setAttribs(array('class'=>'btn btn-success'));
$this->addElements(array($city_name,$country_id,$photo,$description,$submit,$reset));




    }


}
