<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
    }

    public function indexAction()
    {
        // action body
    }
<<<<<<< HEAD
/******************************* ALL **********************************/
    public function allAction()
    {
        // action body
        $country_model = new Application_Model_Country(); //get obj from class user
  	    $this->view->countries = $country_model->allCountries();
    }
/***************************** DELETE ************************************/
    public function deleteAction()
    {
        // action body
        $country_model = new Application_Model_Country();
    		$country_id = $this->_request->getParam("cid");
    		$country_model->deleteCountry($country_id);
    		$this->redirect("/admin/all");
    }
/**************************** UPDATE *************************************/
    public function updateAction()
    {
        // action body
        $form = new Application_Form_Countryform();
    		$country_model = new Application_Model_Country();
        
    		$id = $this->_request->getParam('cid');
    		$country_data = $country_model->updateCountry($id);

    		$form->populate($country_data);
    		$this->view->country_form = $form;

    		$request = $this->getRequest();
    		if($request->isPost())
    		{
      		if($form->isValid($request->getPost()))
      			{
      				$country_model->updateCountry($id, $_POST);
      				$this->redirect('/admin/all');
      			}
        }
     }
/*********************** ADD ********************************/
    public function addAction()
    {
        // action body
        $form = new Application_Form_Countryform();
    		$this->view->country_form= $form;

    		$request=$this->getRequest();
    		if($request->isPost())
    		{
    		  if($form->isValid($request->getPost()))
    		  {
    		  	$countrydata['country_name']=$form->getValue('country_name');
    		  	$country_model = new Application_Model_Country();
    		  	$country_model ->addCountry($countrydata);//($request->getParams());
    		  	$this->redirect('/admin/all');
    		  }
    		}
     }
}
/*****************************************************************/
=======

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


}
>>>>>>> 1ce84ce6d3d6c5c55409fd27a25c8897cab88f16
