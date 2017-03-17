<?php

class Application_Form_Sights extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $sightName = new Zend_Form_Element_Text('sightName');
        $sightName->setLabel('Sight Name : ');
        $sightName->setAttribs(array(
            'class' => 'form-control',
        ));
        $sightName->setRequired(true);

        $city = new Zend_Form_Element_Select('city');
        $city->setLabel('City : ');
        $city->addMultiOption(1,'ay 7aga');
        $city->addMultiOption(2,'ay 7aga tanya');
        $city->setRequired(true);

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttribs(array(
            'class'=> 'btn btn-success'
        ));

        $this->addElements(array($sightName,$city,$submit));
    }





}

