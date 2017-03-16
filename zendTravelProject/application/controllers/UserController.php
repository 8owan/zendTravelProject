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
            $_POST['image'] = "/images/" . $_POST['user_name'] . ".jpg";
            $user_model = new Application_Model_User();
            $user_model->addNewUser($_POST);
            $this->redirect('/admin/user-list');
          }
        }
        $this->view->user_form = $form;
    }

}
