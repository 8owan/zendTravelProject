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

        // $id= new Zend_Form_Element_Text('id');
        //  $id->setLabel('City Id :');
        // $id->setAttribs(array('class'=>'form-control'));
        // $id->setRequired();


        $country_obj= new Application_Model_Country();
        $allCountries = $country_obj->allCountries();
        $country_id= new Zend_Form_Element_Select('country_id');

         $country_id->setLabel('Country Name :');


foreach($allCountries as $key=>$value)
    {
      $country_id->addMultiOption($value['id'], $value['country_name']);
    }




        //  $country_id->setAttribs(array('class'=>'form-control'));
        // $country_id->setRequired();



        // $city_obj = new Application_Model_City();
  //       $allCities = $city_obj->listCity();

  //       $city_id = new Zend_Form_Element_Select('city_id');
  //               $city_id->setLabel('City : ');

  //       foreach($allCities as $key=>$value)
  //       {
  //           $city_id->addMultiOption($value['id'], $value['city_name']);
  //       }






$submit=new Zend_Form_Element_Submit('submit');
        $submit->setAttribs(array('class'=>'btn btn-success'));


$reset=new Zend_Form_Element_Reset('reset');
        $reset->setAttribs(array('class'=>'btn btn-success'));
$this->addElements(array($city_name,$country_id,$submit,$reset));




    }


}
