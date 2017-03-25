<?php

class Application_Form_Sights extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $sightName = new Zend_Form_Element_Text('sight_name');
        $sightName->setLabel('Sight Name : ');
        $sightName->setAttribs(array(
            'class' => 'form-control',
        ));
        $sightName->setRequired(true);

        $city = new Zend_Form_Element_Select('city');
        $cityModel = new Application_Model_City();
        $allCities = $cityModel->listCity();
        foreach ($allCities as $key=>$value){
            $city->addMultiOption($value['id'],$value['city_name']);
        }
        $city->setLabel('City : ');
        $city->setRequired(true);
        $city->setAttribs(array(
            'class' => 'form-control',
        ));

        $submit = new Zend_Form_Element_Submit('ADD');
        $submit->setAttribs(array(
            'class'=> 'btn btn-success'
        ));

        $this->addElements(array($sightName,$city,$submit));
    }





}

