<?php

class AdminController extends Zend_Controller_Action
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

    public function userDetailsAction()
    {
        // action body
        $userModel=new Application_Model_User();
        $id=$this->_request->getParam('uid');
        $userData=$userModel->getUserData($id);
        $this->view->user_data=$userData;
    }

    public function userListAction()
    {
        // action body
        $userModel=new Application_Model_User();
        $user_array=$userModel->getAllUsers();
        $this->view->all_users=$user_array;
    }

    public function userBlockAction()
    {
        // action body
        $user_model = new Application_Model_User ();
        $id = $this->_request->getParam('uid');
        $user_data = $user_model->getUserData($id);
        $user_model->blockUser($id,$user_data);
        $this->redirect('/admin/user-list');
    }

    public function userUnblockAction()
    {
        // action body
        $user_model = new Application_Model_User ();
        $id = $this->_request->getParam('uid');
        $user_data = $user_model->getUserData($id);
        $user_model->unblockUser($id,$user_data);
        $this->redirect('/admin/user-list');
    }

    public function userAsadminAction()
    {
        // action body
        $user_model = new Application_Model_User ();
        $id = $this->_request->getParam('uid');
        $user_data = $user_model->getUserData($id);
        $user_model->makeAdminUser($id,$user_data);
        $this->redirect('/admin/user-list');
    }

    public function loginAction()
    {
        // action body
        $loginform = new Application_Form_AdminLogin();
        $this->view->loginform = $loginform;

        $request = $this->getRequest();
        if($request->isPost()){
          if($loginform->isValid($request->getPost())){
            $email=$request->getParam('email');
            $password=$request->getParam('password');

            $db=Zend_Db_Table::getDefaultAdapter();
            $adaptor=new Zend_Auth_Adapter_DbTable($db,'user','email','password');
            $adaptor->setIdentity($email);
            $adaptor->setCredential($password);

            $result=$adaptor->authenticate();
            if ($result->isValid()) {
              $sessionDataObj=$adaptor->getResultRowObject(['user_name','email','image','type']);
              if ($sessionDataObj->type=='admin') {
                $auth=Zend_Auth::getInstance();
                $storage=$auth->getStorage();
                $storage->write($sessionDataObj);
                $this->redirect('/admin/user-list');
              }
              else {
                print_r('Not Admin');
                die();
              }
            }
          }
        }
    }


}
