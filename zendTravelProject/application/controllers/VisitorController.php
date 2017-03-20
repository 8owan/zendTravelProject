<?php

class VisitorController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function hotelReservationAction()
    {
        // action body

         $form = new Application_Form_Datepicker();

        $this->view->form = $form;

    }

    public function carRequestAction()
    {
        // action body
        $carRequestForm = new Application_Form_CarRequest();
        $request = $this->getRequest();
        if($request->isPost()){
            if($carRequestForm->isValid($request->getPost())){
                $carModel = new Application_Model_CarRequest();
                $carModel->addCarRequest($request->getParams());
                $this->redirect('/visitor/car-Request');
            }
        }
        $this->view->carRequest = $carRequestForm;
    }


}
