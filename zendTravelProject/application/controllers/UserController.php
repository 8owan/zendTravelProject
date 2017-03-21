<?php

class UserController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }

    public function addUserAction()
    {
        // action body
        $form = new Application_Form_SignUp();
        $request = $this->getRequest();
        if ($request->isPost()) {
          if ($form->isValid($request->getPost())) {
            $upload = new Zend_File_Transfer_Adapter_Http();
            $url=dirname(__DIR__,2)."/public/images/";
            $upload->addFilter('Rename', $url.$_POST['user_name'].".jpg");
            $upload->receive();
            $_POST['image'] = "/images/" . $_POST['user_name'].".jpg";
            $user_model = new Application_Model_User();
            $user_model->addNewUser($_POST);
            $this->redirect('/admin/user-list');
          }
        }
        $this->view->user_form = $form;
    }

    public function homeAction()
    {
        // action body
        $city=new Application_Model_City();
        $allCitys=$city->listCity();

        $exp=new Application_Model_Experience();
        $top=$exp->getTopExperience($allCitys);

        $country=new Application_Model_Country();
        $allCountries=$country->allCountries();

        $this->view->allCountries = $allCountries;
        $this->view->allCitys = $allCitys;
        $this->view->topExp = $top;
    }

    public function edituserdataAction()
    {
        // action body
        $form = new Application_Form_SignUp();

        $auth=Zend_Auth::getInstance();
        $identity = $auth->getStorage();
        $userData=$identity->read();
        $user_id=$userData->id;
        // print_r($user_id);
        // die();


        //  $user_id = $this->_request->getParam('id');
          $this->view->uid = $user_id;

        $user_model = new Application_Model_User ();

        $user_data = $user_model->getUserData($user_id);
        $form->populate($user_data);

    		$this->view->signup_form = $form;

        $request = $this->getRequest();
    		if($request->isPost())
    		{
      		if($form->isValid($request->getPost()))
      			{
      				$user_model->editUserData($user_id, $_POST);
      				//  $this->redirect('/user/add-user');

      			}
       	}
    }
}
