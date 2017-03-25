<?php

class Application_Form_Datepicker extends ZendX_JQuery_Form
{


    public function init()
    {
/////////////////////////////////////////////////////
    	 // $hotelModel = new Application_Model_HotelRequest();
      //   $allhotels = $hotelModel->listhotel();
      //   $hotel = new Zend_Form_Element_Select('id');
      //   $hotel->setLabel('Hotel : ');
      //   $hotel->setAttribs(array('class'=>'form-control'));
      //   $hotel->setRequired();

      //   foreach ($allhotels as $key=>$value){
      //       $hotel->addMultiOption($value['id'],$value['hotel_name']);
      //   }

///////////////////////////////////////////////////////////////////////

        /* Form Elements & Other Definitions Here ... */
	 	 $hotelModel = new Application_Model_Hotel();
	     $allhotels = $hotelModel->listHotel();

	 	$hotel_name= new Zend_Form_Element_Select('hotel_id');
	    $hotel_name->setLabel('Hotels :');
	    foreach ($allhotels as $key=>$value){
           $hotel_name->addMultiOption($value['id'],$value['hotel_name']);
      	 }


     
     
        $from = new ZendX_JQuery_Form_Element_DatePicker('start_date', array("label" => 'from'." (yyyy-mm-dd)"));
		$from->setJQueryParams(array(
				'dateFormat'=>'yy-mm-dd',
				'changeMonth'=> true,
				'changeYear'=> true
				))
				->setDecorators(array(
				array('UiWidgetElement', array('tag' => '')),
				array('Errors'),
				array('HtmlTag', array('tag' => 'div', 'class'=>'span-11 last')),
				array('Label', array('tag' => 'div', 'class'=>'span-5 clear'))
			));



 		$to = new ZendX_JQuery_Form_Element_DatePicker('end_date', array("label" => 'to'." (yyyy-mm-dd)"));
		$to->setJQueryParams(array(
				'dateFormat'=>'yy-mm-dd',
				'changeMonth'=> true,
				'changeYear'=> true
				))
			->setDecorators(array(
			array('UiWidgetElement', array('tag' => '')),
			array('Errors'),
			array('HtmlTag', array('tag' => 'div', 'class'=>'span-11 last')),
			array('Label', array('tag' => 'div', 'class'=>'span-5 clear'))
			));	

	$no_of_rooms= new Zend_Form_Element_Text('no_of_rooms');
        $no_of_rooms->setLabel('no_of_rooms :');
        $no_of_rooms->setAttribs(array('placeholder'=>'no_of_rooms','class'=>'form-control'));
        $no_of_rooms->setRequired();
        //m7taga anady 3l Hotel moel w an2s el rooms wa7d lw hya b nfs id elhotel
        // $update_num_of_rooms=new Application_Model_Hotel();


$submit=new Zend_Form_Element_Submit('Submit');
        $submit->setAttribs(array(
          'class'=>'btn btn-success'
        ));

$this->addElements(array($hotel_name,$no_of_rooms,$from,$to,$submit));

    }


}
