<?php

class AdminController extends Zend_Controller_Action
{

    public function init()
    {
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
       $hotel_model = new Application_Model_Hotel();
        $this->view->hotel = $hotel_model->listHotel();
        ///////////////////////////////////////////////////////
         $city_model = new Application_Model_City();
        $this->view->city = $city_model->listCity();
         $country_model = new Application_Model_Country(); //get obj from class user
        $this->view->countries = $country_model->allCountries();
        ////////////////////////////////////////////////////////
         $sightModel = new Application_Model_Sights();
        $this->view->allSights = $sightModel->listSights();
/////////////////////////////////////////////////////////////////

     $userModel=new Application_Model_User();
        $user_array=$userModel->getAllUsers();
        $this->view->all_users=$user_array;

    }

    public function addsightAction()
    {

        $sightForm = new Application_Form_Sights();
        $request = $this->getRequest();
        if($request->isPost()){
            if($sightForm->isValid($request->getPost())){
                $sight_model = new Application_Model_Sights();
                $sight_model->addSight($request->getParams());
                $this->redirect('/admin/index');
            }
        }
        $this->view->sightForm = $sightForm;
    }

    public function editsightAction()
    {

        $sightForm = new Application_Form_Sights();
        $sightModel = new Application_Model_Sights();
        $sightId = $this->_request->getParam('sightid');
        $sightData = $sightModel-> sightDetails ($sightId)[0];
        $sightForm->populate($sightData);
        $this->view->sightForm = $sightForm;
        $request = $this->getRequest ();
        if($request->isPost()){
            if($sightForm-> isValid($request-> getPost())){
                $sightModel-> editSight($sightId, $_POST);
                $this->redirect('/admin/index');
            }
        }

    }

    public function listsightsAction()
    {

        $sightModel = new Application_Model_Sights();
        $this->view->allSights = $sightModel->listSights();

    }

    public function sightdetailsAction()
    {

        $sightModel = new Application_Model_Sights();
        $sightId = $this->_request->getParam('sightid');
        $sightData = $sightModel->sightDetails($sightId);
        $this->view->sightData = $sightData[0];

    }

    public function deletesightAction()
    {

        $sightModel = new Application_Model_Sights();
        $sightId = $this->_request->getParam('sightid');
        $sightModel->deleteSight($sightId);
        $this->redirect("/admin/index");

    }

    public function addCityAction()
    {
        // action body
         $form=new Application_Form_Addcity();
        $request=$this->getRequest();
        if($request->isPost()){
            if($form->isValid($request->getPost())){
                $city_model=new Application_Model_City();
                $city_model->addCity($request->getParams());
                $this->redirect('/admin/index');
            }
        }

        $this->view->city_form = $form;
    }

    public function listCityAction()
    {
        // action body
        $city_model = new Application_Model_City();
        $this->view->city = $city_model->listCity();
    }

    public function deleteCityAction()
    {
        // action body
          $city_model = new Application_Model_City();
        $city_id = $this->_request->getParam("uid");
        $city_model->deleteCity($city_id);
        $this->redirect("/admin/index");
    }

    public function cityDetailsAction()
    {
        // action body
        $city_model=new Application_Model_City();
        $city_id=$this->_request->getParam("uid");
        $city=$city_model->cityDetails($city_id);

        $country=new Application_Model_Country();
        $countryName=$country->allCountries();

        $this->view->city=$city[0];
        $this->view->countryName=$countryName[0];

    }

    public function cityUpdateAction()
    {
        // action body
             $form = new Application_Form_Addcity ();
        $city_model = new Application_Model_City ();
        $id = $this->_request->getParam('uid');
        $CityData = $city_model-> cityDetails ($id)[0];

        $form->populate($CityData);
        $this->view->city_form = $form;
        $request = $this->getRequest ();
        if($request-> isPost()){
          if($form-> isValid($request-> getPost())){
            $city_model-> updateCity ($id,$_POST);
        $this->redirect('/admin/index ');
}
}

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
        $this->redirect('/admin/index');
    }

    public function userUnblockAction()
    {
        // action body
        $user_model = new Application_Model_User ();
        $id = $this->_request->getParam('uid');
        $user_data = $user_model->getUserData($id);
        $user_model->unblockUser($id,$user_data);
        $this->redirect('/admin/index');
    }

    public function userAsadminAction()
    {
        // action body
        $user_model = new Application_Model_User ();
        $id = $this->_request->getParam('uid');
        $user_data = $user_model->getUserData($id);
        $user_model->makeAdminUser($id,$user_data);
        $this->redirect('/admin/index');
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
              $sessionDataObj=$adaptor->getResultRowObject(['user_name','email','image','type','id']);

              if ($sessionDataObj->type=='admin') {
                $auth=Zend_Auth::getInstance();
                $storage=$auth->getStorage();
                $storage->write($sessionDataObj);
                $this->redirect('/admin/user-list');
              }
              elseif ($sessionDataObj->type=='blocked') {
                echo "<script>alert('contact the admin!! you are blocked');</script>";
              }
              elseif ($sessionDataObj->type=='normal')
              {
                print_r('Not Admin');
                die();
              }
            }
          }

        }
    }

    public function addHotelAction()
    {
        // action body
        $form = new Application_Form_Addhotel();
        $request = $this->getRequest();
        if($request->isPost()){
        if($form->isValid($request->getPost())){
        $hotel_model = new Application_Model_Hotel();
        $hotel_model-> addHotel($request->getParams());
        $this->redirect('/admin/index');
        }
        }
        $this->view->hotel_form = $form;

    }

    public function deleteHotelAction()
    {
        // action body
        $Hotel_model = new Application_Model_Hotel();
        $Hotel_id = $this->_request->getParam("uid");
        $Hotel_model->deleteHotel($Hotel_id);
        $this->redirect("/admin/index");
    }

    public function listHotelAction()
    {
        // action body
         $hotel_model = new Application_Model_Hotel();
        $this->view->hotel = $hotel_model->listHotel();
    }

    public function hotelDetailsAction()
    {
        // action body
        $hotel_model=new Application_Model_Hotel();
        $hotel_id=$this->_request->getParam("uid");
        $hotel=$hotel_model->hotelDetails($hotel_id);
        $city_model=new Application_Model_City();
        $cityName=$city_model->listCity();
        $this->view->hotel=$hotel[0];
        $this->view->city=$cityName[0];
    }

    public function updateHotelAction()
    {
        // action body
        $form = new Application_Form_Addhotel ();
        $hotel_model = new Application_Model_Hotel ();
        $id = $this->_request->getParam('uid');
        $HotelData = $hotel_model-> hotelDetails($id)[0];

        $form->populate($HotelData);
        $this->view->hotel_form = $form;
        $request = $this->getRequest ();
        if($request-> isPost()){
        if($form-> isValid($request-> getPost())){
        $hotel_model-> updateHotel ($id,$_POST);
        $this->redirect('/admin/index');
}
}
    }
/******************************* ALL country **********************************/
    public function displaycountriesAction()
    {
        // action body
        $country_model = new Application_Model_Country(); //get obj from class user
        $this->view->countries = $country_model->allCountries();
    }

    /***************************** DELETE country ************************************/

    public function deletecountryAction()
    {
        // action body
        $country_model = new Application_Model_Country();
        $country_id = $this->_request->getParam("cid");
        $country_model->deleteCountry($country_id);
        $this->redirect("/admin/index");
    }

/*********************** ADD country ********************************/
    public function addcountryAction()
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

                $upload = new Zend_File_Transfer_Adapter_Http();
                $url=dirname(__DIR__,2)."/public/images/";
                // print_r($url);
                // die();
                $upload->addFilter('Rename', $url.$_POST['country_name'].".jpg");
                $upload->receive();
                $countrydata['image'] = "/images/" . $_POST['country_name'].".jpg";

                $country_model = new Application_Model_Country();
                $country_model ->addCountry($countrydata);//($request->getParams());
                $this->redirect('/admin/index');
              }
            }
    }
/**************************** UPDATE country *************************************/
    public function updatecountryAction()
    {
        // action body
        $form = new Application_Form_Countryform();
        $id = $this->_request->getParam('cid');
            $country_model = new Application_Model_Country();
            $country_data = $country_model->getCountryData($id);

            $form->populate($country_data);
            $this->view->country_form = $form;

            $request = $this->getRequest();
            if($request->isPost())
            {
            if($form->isValid($request->getPost()))
                {
                    $country_model->updateCountry($id, $_POST);
                    $this->redirect('/admin/index');
                }
        }
    }


}
