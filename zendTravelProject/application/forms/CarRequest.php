<?php

class Application_Form_CarRequest extends ZendX_JQuery_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $this->setMethod('POST');
        $sightModel = new Application_Model_Sights();
        $allSights = $sightModel->listSights();
        $sight = new Zend_Form_Element_Select('sightId');
        $sight->setLabel('Sight : ');
        $sight->setAttribs(array('class'=>'form-control',));
        $sight->setRequired(true);

        foreach ($allSights as $key=>$value){
            $sight->addMultiOption($value['id'],$value['sight_name']);
        }

//        $startDate = new Zend_Dojo_Form_Element_DateTextBox('startDate');
//        $startDate->setLabel('From : ');
//        $startDate->setRequired(true);
//        $startDate->setAttribs(array(
//            'class'=> 'form-inline'
//        ));
//        $endDate = new Zend_Dojo_Form_Element_DateTextBox('endDate');
//        $endDate->setLabel('TO : ');
//        $endDate->setRequired(true);
//        $endDate->setAttribs(array(
//            'class'=> 'form-inline'
//        ));

        $textElement = new ZendX_JQuery_Form_Element_DatePicker('dtPicker', array("label" => 'Date Picker :'." (yyyy-mm-dd)"));
        $textElement->setJQueryParams(array(
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
//        $this->addElement('datePicker','movie_release_date', array(
//                'label' => 'Release Date:',
//                'required'=> false,
//                'class' => 'dtPicker',
//            )
//        );



        $textElement2 = new ZendX_JQuery_Form_Element_DatePicker('dtPicker', array("label" => 'Date Picker :'." (yyyy-mm-dd)"));
        $textElement2->setJQueryParams(array(
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
        $this->addElement('datePicker','movie_release_date', array(
                'label' => 'Release Date:',
                'required'=> false,
                'class' => 'dtPicker',
            )
        );

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttribs(array(
            'class'=> 'btn btn-success'
        ));

        $this->addElements(array($sight,$textElement,$submit));
        $this->addElement($textElement2);
    }


}

