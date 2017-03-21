<?php

class UserController extends Zend_Controller_Action
{
    public $fpS = null;
    public function init()
    {
        /* Initialize action controller here */
        $authorization = Zend_Auth::getInstance();
    		$this->fpS = new Zend_Session_Namespace('facebook');

    		$request=$this->getRequest();
    		$actionName=$request->getActionName();

    		if ((!$authorization->hasIdentity() && !isset($this->fpS->fname))
         && ($actionName != 'login' && $actionName != 'fblogin' && $actionName !='fbcallback'))
    		{
    		    $this->redirect('/admin/login');
    		}


    		if (($authorization->hasIdentity() || isset($this->fpS->fname))
        && ($actionName == 'login' || $actionName == 'fblogin'))
    		{
    		    $this->redirect('/admin/user-list');
    		}
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
