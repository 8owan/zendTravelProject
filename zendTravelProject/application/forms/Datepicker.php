<?php

class Application_Form_Datepicker extends ZendX_JQuery_Form
{


    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
	 	$hotel_name= new Zend_Form_Element_Select('hotel_name');
	    $hotel_name->setLabel('Hotels :');
     
     
        $from = new ZendX_JQuery_Form_Element_DatePicker('dtPicker', array("label" => 'from'." (yyyy-mm-dd)"));
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



 		$to = new ZendX_JQuery_Form_Element_DatePicker('dtPicker2', array("label" => 'to'." (yyyy-mm-dd)"));
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



$this->addElements(array($hotel_name,$from,$to));

    }


}
