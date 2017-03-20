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

    public function addExperienceAction()
    {
        // action body
          $form = new Application_Form_AddExperience();
        $request = $this->getRequest();
        if ($request->isPost()) {
          if ($form->isValid($request->getPost())) {
            $upload = new Zend_File_Transfer_Adapter_Http();
            $url=dirname(__DIR__,2)."/public/images/";
            $upload->addFilter('Rename', $url.$_POST['title'].".jpg");
            $upload->receive();
            $_POST['photo'] = "/images/" . $_POST['title'].".jpg";

            ///////////////// ay klam fady  ////////
            $auth=Zend_Auth::getInstance();
            $identity = $auth->getStorage();
            $userData=$identity->read();
            $user_id=$userData->id;
            // die();

            $experience_model = new Application_Model_Experience();
            $experience_model->addExperience($request->getParams(), $user_id);
            $this->redirect('/visitor/add-experience');
          }
        }
        $this->view->experience_form = $form;
    // }

    }

    public function deleteExperienceAction()
    {
        // action body
           $experience_model = new Application_Model_Experience();
        $experience_id = $this->_request->getParam("uid");
        $experience_model->deleteExperience($experience_id);
        $this->redirect("/visitor/list-experience");
    }

    public function updateExperienceAction()
    {
        // action body
        $form = new Application_Form_AddExperience ();
        $experience_model = new Application_Model_Experience();
        $id = $this->_request->getParam('uid');
        $experienceData = $experience_model-> experienceDetails ($id)[0];
        $auth=Zend_Auth::getInstance();
            $identity = $auth->getStorage();
            $userData=$identity->read();
            $user_id=$userData->id;
        $form->populate($experienceData);
        $this->view->experience_form = $form;
        $request = $this->getRequest ();
        if($request-> isPost()){
        if($form-> isValid($request-> getPost())){
        $experience_model-> updateExperience ($id,$_POST, $user_id);
        $this->redirect('/visitor/add-experience ');
}
}
    }

    public function listExperienceAction()
    {
        // action body
        $experience_model = new Application_Model_Experience();
        $this->view->experience = $experience_model->listExperience();
    }

    public function experienceDetailsAction()
    {
        // action body
        $experience_model=new Application_Model_Experience();
        $experience_id=$this->_request->getParam("uid");
        $experience=$experience_model->experienceDetails($experience_id);
        $this->view->experience=$experience[0];
    }


}
