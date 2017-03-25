<?php

class VisitorController extends Zend_Controller_Action
{

    public $fpS = null;

    public function init()
    {
        /* Initialize action controller here */
        $authorization = Zend_Auth::getInstance();
        $this->fpS = new Zend_Session_Namespace('facebook');

        $request=$this->getRequest();
        $actionName=$request->getActionName();

    		if ((!$authorization->hasIdentity() && !isset($this->fpS->user_name)) &&
        ($actionName != 'login' && $actionName != 'fblogin' && $actionName !='fbcallback'))
    		{
    		    $this->redirect('/admin/login');
    		}


    		if (($authorization->hasIdentity() || isset($this->fpS->user_name))
        && ($actionName == 'login' || $actionName == 'fblogin'))
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

          $request = $this->getRequest();
        if($request->isPost()){
            if($form->isValid($request->getPost())){
                $hotelModel = new Application_Model_HotelRequest();
                $hotelModel->addHotelRequest($request->getParams());
                $this->redirect('/visitor/hotel-reservation');
            }
        }
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

    public function profileAction()
    {
        // action body
        $userModel=new Application_Model_User();
        $auth=Zend_Auth::getInstance();
            $identity = $auth->getStorage();
            $userData=$identity->read();
            $user_id=$userData->id;

        // $id=$this->_request->getParam('uid');
        $userData=$userModel->getUserData($user_id);
        $this->view->user_data=$userData;
/*******************************car request************************************/
        $car_model = new Application_Model_CarRequest();
        $car_req = $car_model->getCarReq($user_id);
        // print_r($car_req);
        // die();
        $this->view->car_req = $car_req;
/*******************************hotel request**********************************/
        $hotel_model = new Application_Model_HotelRequest();
        $hotel_req = $hotel_model->getHotelReq($user_id);
        $this->view->hotel_req = $hotel_req;
/*******************************experience*************************************/
        $form = new Application_Form_AddExperience();
        $request = $this->getRequest();
        if ($request->isPost())
        {
          if ($form->isValid($request->getPost()))
          {
            $upload = new Zend_File_Transfer_Adapter_Http();
            $url=dirname(__DIR__,2)."/public/images/";
            $upload->addFilter('Rename', $url.$_POST['title'].".jpg");
            $upload->receive();
            $_POST['photo'] = "/images/" . $_POST['title'].".jpg";

            $experience_model = new Application_Model_Experience();
            $experience_model->addExperience($request->getParams(), $user_id);
          }
        }
      $this->view->experience_form = $form;

    }

    public function editprofileAction()
    {
        // action body
        $form = new Application_Form_SignUp();

        $auth=Zend_Auth::getInstance();
        $identity = $auth->getStorage();
        $userData=$identity->read();
        $user_id=$userData->id;
        $user_type=$userData->type;
        if($user_type=="blocked")
        {
          echo "<script>alert('contact the admin!! you are blocked');window.location.href='/user/home';</script>";
        }

        $this->view->uid = $user_id;

        $user_model = new Application_Model_User();

        $user_data = $user_model->getUserData($user_id);
        $form->populate($user_data);

    		$this->view->signup_form = $form;

        $request = $this->getRequest();
    		if($request->isPost())
    		{
      		if($form->isValid($request->getPost()))
      			{
      				$user_model->editUserData($user_id, $_POST);
      				 $this->redirect('/user/home');

      			}
       	}
    }


}
