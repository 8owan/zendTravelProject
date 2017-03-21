<?php

class Application_Form_Countryform extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $id = new Zend_Form_Element_Text('id');

        $country_name = new Zend_Form_Element_Text('country_name');
    		$country_name->setLabel('Country Name: ');
    		$country_name->setAttrib('class','form-control');   //style
    		$country_name->setRequired();
    		$country_name->addValidator('StringLength',false,Array(3,20));
    		$country_name->addFilter('StringTrim'); //to remove to much spaces bet names

        $image = new Zend_Form_Element_File('image');
        $image->setLabel('Upload an image:');
        $image->addValidator('Count', false, 1);
        $image->addValidator('Extension',false, 'jpg,jpeg,png,gif');

    		$submit= new Zend_Form_Element_Submit('save');
    		$submit->setAttribs(array('class'=>'btn btn-success'));

    		$reset= new Zend_Form_Element_Submit('cancel');
    		$reset->setAttribs(array('class'=>'btn btn-danger'));

    		$this->addElements(array($country_name,$image,$submit,$reset));
    }
}
