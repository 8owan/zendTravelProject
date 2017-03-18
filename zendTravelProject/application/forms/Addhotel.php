<?php

class Application_Form_Addhotel extends Zend_Form
{

    public function init()
    {
    	$this->setMethod('POST');
    	// $id = new Zend_Form_Element_Hidden('id');
        /* Form Elements & Other Definitions Here ... */
        $hotel_name= new Zend_Form_Element_Text('hotel_name');
        $hotel_name->setLabel('Hotel Name :');
        $hotel_name->setAttribs(array('placeholder'=>'Hotel Name','class'=>'form-control'));
        $hotel_name->setRequired();

        // $id= new Zend_Form_Element_Text('id');
        //  $id->setLabel('Hotel Id :');
        // $id->setAttribs(array('class'=>'form-control'));
        // $id->setRequired();



        $avail_room= new Zend_Form_Element_Text('avail_room');
        $avail_room->setLabel('Available rooms :');
        $avail_room ->setAttribs(array('class'=>'form-control'));
        $avail_room->setRequired();




		$city_obj = new Application_Model_City();
		$allCities = $city_obj->listCity();

		$city_id = new Zend_Form_Element_Select('city_id');
		$city_id->setLabel('City : ');

		foreach($allCities as $key=>$value)
		{
			$city_id->addMultiOption($value['id'], $value['city_name']);
		}



    //     $cityName = new Zend_Form_Element_Select('cityName');
    //     // $cityName->setRequired();

    //     foreach ($cityName as $key => $value) {
    //     	# code...
        
    //     $cityName->addMultiOptions($value[$id]);
    // }
$submit=new Zend_Form_Element_Submit('submit');
		$submit->setAttribs(array('class'=>'btn btn-success'));


$reset=new Zend_Form_Element_Reset('reset');
		$reset->setAttribs(array('class'=>'btn btn-success'));
$this->addElements(array($hotel_name,$avail_room,$city_id,$submit,$reset));


    }


}