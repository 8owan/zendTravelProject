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

        $startDate = new ZendX_JQuery_Form_Element_DatePicker('start_date', array("label" => 'Start Date :'));
        $startDate->setJQueryParams(array(
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




        $endDate = new ZendX_JQuery_Form_Element_DatePicker('end_date', array("label" => 'End Date :'));
        $endDate->setJQueryParams(array(
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
        // $this->addElement('datePicker','movie_release_date', array(
        //         'label' => 'Release Date:',
        //         'required'=> false,
        //         'id' => 'datepicker',
        //         'class' => 'datepicker',
        //     )
        // );

        $submit = new Zend_Form_Element_Submit('submit');
        $submit->setAttribs(array(
            'class'=> 'btn btn-success'
        ));

        $this->addElements(array($sight,$startDate,$submit));
        $this->addElement($endDate);
    }


}
