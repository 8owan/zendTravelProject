<?php

class VisitorController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
        $authorization = Zend_Auth::getInstance();

        $request=$this->getRequest();
        $actionName=$request->getActionName();

        if (!$authorization->hasIdentity() && $actionName != 'login')
        {
            $this->redirect('/admin/login');
        }


        if ($authorization->hasIdentity()&& $actionName == 'login')
        {
            $this->redirect('/admin/user-list');
        }
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
        // action bodyica
        $experience_model = new Application_Model_Experience();
        $this->view->experience = $experience_model->listExperience();

        //getting exp_id
        $experience_id = $this->_request->getParam("exp_id");
        $commentModel = new Application_Model_Comment();

//        //displaying all comments on experiences
//        $commentModel = new Application_Model_Comment();
//        $exp_comments = $commentModel->listComments();
//        $this->view->expComments = $exp_comments;

        // geting info about the logged in user

        $auth=Zend_Auth::getInstance();
        $identity = $auth->getStorage();
        $userData=$identity->read();
        $user_id=$userData->id;

        //user info of each comment
        $allCommentData = $commentModel->allCommentsData();
        $this->view->allCommentData = $allCommentData;

        // displaying comment form for each experience
        $commentForm = new Application_Form_Comment();
        $request = $this->getRequest();
        if($this->_request->getParam("delexpid")){
            $commentId = $this->_request->getParam("delexpid");
            $commentModel->deleteComment($commentId);
            $this->redirect("/visitor/list-experience");
        }
        if($this->_request->getParam("editexpid")){
            $commentId = $this->_request->getParam("editexpid");
            $commentData = $commentModel-> commentDetails ($commentId)[0];
            $commentForm->populate($commentData);
            $this->view->commentForm = $commentForm;
            $request = $this->getRequest ();
            if($request->isPost()){
                if($commentForm-> isValid($request-> getPost())){
                    $commentModel-> editComment($commentId, $_POST);
                    $this->redirect("/visitor/list-experience");
                }
            }
        }
        if($request->isPost()){
            if($commentForm->isValid($request->getPost())){

                $commentModel->addComment($request->getParams(),$user_id,$experience_id);
                $this->redirect('/visitor/list-Experience');
            }
        }
        $this->view->commentForm = $commentForm;

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


