<?php

class UserController extends Zend_Controller_Action
{

    public $fpS = null;

    public function init()
    {
        /* Initialize action controller here */
        // $authorization = Zend_Auth::getInstance();
    		// $this->fpS = new Zend_Session_Namespace('facebook');
        //
    		// $request=$this->getRequest();
    		// $actionName=$request->getActionName();
        //
    		// if ((!$authorization->hasIdentity() && !isset($this->fpS->user_name))
        //  && ($actionName != 'login' && $actionName != 'fblogin' && $actionName !='fbcallback'))
    		// {
    		//     $this->redirect('/admin/login');
    		// }
        //
        //
    		// if (($authorization->hasIdentity() || isset($this->fpS->user_name))
        // && ($actionName == 'login' || $actionName == 'fblogin'))
    		// {
    		//     $this->redirect('/admin/user-list');
    		// }

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

            $db=Zend_Db_Table::getDefaultAdapter();
            $adaptor=new Zend_Auth_Adapter_DbTable($db,'user','email','password');
            $adaptor->setIdentity($_POST['email']);
            $adaptor->setCredential($_POST['password']);
            $result=$adaptor->authenticate();
            if ($result->isValid()) {
              $sessionDataObj=$adaptor->getResultRowObject(['user_name','email','image','type','id']);

              if ($sessionDataObj->type=='normal')
              {
                $auth=Zend_Auth::getInstance();
                $storage=$auth->getStorage();
                $storage->write($sessionDataObj);
                $this->redirect('/user/home');
              }
            }

            // $this->redirect('/admin/login');
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

    public function logoutAction()
    {
        // action body
        $authAdapter=Zend_Auth::getInstance();
        $authAdapter->clearIdentity();
        Zend_Session::namespaceUnset('facebook');
        $this->redirect('/admin/login');
    }

}
