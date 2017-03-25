<?php

class AdminController extends Zend_Controller_Action
{

    public $fpS = null;

    public function init()
    {
      $authorization = Zend_Auth::getInstance();
  		$this->fpS = new Zend_Session_Namespace('facebook');

  		$request=$this->getRequest();
  		$actionName=$request->getActionName();

  		if ((!$authorization->hasIdentity() && !isset($this->fpS->user_name))
      && ($actionName != 'login' && $actionName != 'fblogin' && $actionName !='fbcallback'))
  		{
  		    $this->redirect('/admin/login');
  		}


  		if (($authorization->hasIdentity() || isset($this->fpS->user_name))
       && ($actionName == 'login' || $actionName == 'fblogin'))
  		{
  		    $this->redirect('/admin');
  		}

      if ($authorization->hasIdentity()) {
        $storage=$authorization->getStorage();
        $userData=$storage->read();
        if ($userData->type!='admin') {
          $this->redirect('/user/home');
        }
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
    public function preDispatch(){
        $this->_helper->layout()->disableLayout();

        // $this->_helper->viewRenderer->setNoRender(true);
    }
    
    public function addsightAction()
    {

        $sightForm = new Application_Form_Sights();
        $request = $this->getRequest();
        if($request->isPost()){
            if($sightForm->isValid($request->getPost())){
                $sight_model = new Application_Model_Sights();
                $sight_model->addSight($request->getParams());
                $this->redirect('/admin');
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
                $this->redirect('/admin');
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


        $city=new Application_Model_City();

        $cityName=$city->cityDetails($sightData[0]['city_id']);
        $this->view->cityName= $cityName[0]['city_name'];

    }

    public function deletesightAction()
    {

        $sightModel = new Application_Model_Sights();
        $sightId = $this->_request->getParam('sightid');
        $sightModel->deleteSight($sightId);
        $this->redirect("/admin");

    }

    public function addCityAction()
    {
        // action body
         $form=new Application_Form_Addcity();
        $request=$this->getRequest();
        if($request->isPost()){
            if($form->isValid($request->getPost())){
                $upload = new Zend_File_Transfer_Adapter_Http();
            $url=dirname(__DIR__,2)."/public/images/";
            $upload->addFilter('Rename', $url.$_POST['city_name'].".jpg");
            $upload->receive();
            $_POST['photo'] = "/images/" . $_POST['city_name'].".jpg";

                $city_model=new Application_Model_City();
                $city_model->addCity($request->getParams());
                $this->redirect('/admin');
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
        $this->redirect("/admin");
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
        $this->redirect('/admin');
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
        $this->redirect('/admin');
    }

    public function userUnblockAction()
    {
        // action body
        $user_model = new Application_Model_User ();
        $id = $this->_request->getParam('uid');
        $user_data = $user_model->getUserData($id);
        $user_model->unblockUser($id,$user_data);
        $this->redirect('/admin');
    }

    public function userAsadminAction()
    {
        // action body
        $user_model = new Application_Model_User ();
        $id = $this->_request->getParam('uid');
        $user_data = $user_model->getUserData($id);
        $user_model->makeAdminUser($id,$user_data);
        $this->redirect('/admin');
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
                $this->redirect('/admin');
              }
              elseif ($sessionDataObj->type=='blocked') {
                echo "<script>alert('contact the admin!! you are blocked');</script>";
              }
              elseif ($sessionDataObj->type=='normal')
              {
                $auth=Zend_Auth::getInstance();
                $storage=$auth->getStorage();
                $storage->write($sessionDataObj);
                $this->redirect('/user/home');
              }
            }
          }

        }
        $fb = new Facebook\Facebook([
  			'app_id' => '1836874743221542', // Replace {app-id} with your app id
  			'app_secret' => '9ee8b295986c9c5091df073eccff3f4e',
  			'default_graph_version' => 'v2.2',
  			]);
  			$helper = $fb->getRedirectLoginHelper();

  			$loginUrl = $helper->getLoginUrl($this->view->serverUrl() .'/admin/fbcallback',array('scope'=>'email'));
  			$this->view->facebookUrl = $loginUrl;
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
        $this->redirect('/admin');
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
        $this->redirect("/admin");
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
        $this->redirect('/admin');
}
}
    }

    public function displaycountriesAction()
    {
        // action body
        $country_model = new Application_Model_Country(); //get obj from class user
        $this->view->countries = $country_model->allCountries();
    }

    public function deletecountryAction()
    {
        // action body
        $country_model = new Application_Model_Country();
        $country_id = $this->_request->getParam("cid");
        $country_model->deleteCountry($country_id);
        $this->redirect("/admin");
    }

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
                $this->redirect('/admin');
              }
            }
    }

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
                    $this->redirect('/admin');
                }
        }
    }

    public function fbloginAction()
    {
        // action body
      // $fb = new Facebook\Facebook([
			// 'app_id' => '1836874743221542', // Replace {app-id} with your app id
			// 'app_secret' => '9ee8b295986c9c5091df073eccff3f4e',
			// 'default_graph_version' => 'v2.2',
			// ]);
			// $helper = $fb->getRedirectLoginHelper();
      //
			// $loginUrl = $helper->getLoginUrl($this->view->serverUrl() .'/admin/fbcallback');
			// $this->view->facebookUrl = $loginUrl;
    }

    public function fbcallbackAction()
    {
          // action body
      $fb = new Facebook\Facebook([
  		'app_id' => '1836874743221542', // Replace {app-id} with your app id
  		'app_secret' => '9ee8b295986c9c5091df073eccff3f4e',
  		'default_graph_version' => 'v2.2',
  		]);
  		$helper = $fb->getRedirectLoginHelper();
  		try {
  		$accessToken = $helper->getAccessToken();
  		} catch(Facebook\Exceptions\FacebookResponseException $e) {
  		// When Graph returns an error
  		echo 'Graph returned an error: ' . $e->getMessage();
		  exit;
		} catch(Facebook\Exceptions\FacebookSDKException $e) {
		// When validation fails or other local issues
  		echo 'Facebook SDK returned an error: ' . $e->getMessage();
  		exit;
		}
		if (! isset($accessToken)) {
  		if ($helper->getError()) {
    		header('HTTP/1.0 401 Unauthorized');
    		echo "Error: " . $helper->getError() . "\n";
    		echo "Error Code: " . $helper->getErrorCode() . "\n";
    		echo "Error Reason: " . $helper->getErrorReason() . "\n";
    		echo "Error Description: " . $helper->getErrorDescription() . "\n";
  		} else {
    		header('HTTP/1.0 400 Bad Request');
    		echo 'Bad request';
  		}
		exit;
		}
		// The OAuth 2.0 client handler helps us manage access tokens
		$oAuth2Client = $fb->getOAuth2Client();
		if (! $accessToken->isLongLived()) {
		// Exchanges a short-lived access token for a long-lived one
		try {
		    $accessToken = $oAuth2Client->getLongLivedAccessToken($accessToken);
		} catch (Facebook\Exceptions\FacebookSDKException $e) {
  		echo "<p>Error getting long-lived access token: " . $helper->getMessage() . "</p>\n\n";
  		exit;
		}
		  echo '<h3>Long-lived</h3>';
		}
  		$fb->setDefaultAccessToken($accessToken);
  		try {
  		$response = $fb->get('/me? fields=id,name,email');
  		$userNode = $response->getGraphUser();
      // print_r($userNode);
      // die();
		}
  		catch (Facebook\Exceptions\FacebookResponseException $e) {
  		// When Graph returns an error
  		echo 'Graph returned an error: ' . $e->getMessage();
  		Exit;
		}
  		catch (Facebook\Exceptions\FacebookSDKException $e) {
  		// When validation fails or other local issues
  		echo 'Facebook SDK returned an error: ' . $e->getMessage();
  		Exit;
		}
      $data['user_name'] = $userNode['name'];
      $data['email'] = $userNode['email'];
      $data['image'] = "";
      $data['password'] = "";
      $data['type']='normal';
      $userfc = new Application_Model_User();
      if(!$userfc->checkEmail($data['email']))
      {
        $userfc->addNewUser($data);
      }
        $ret = $userfc->checkEmail($data['email']);
        // var_dump($ret[0]);exit;
          $auth=Zend_Auth::getInstance();
          $identity = $auth->getStorage();
          $user_id_s = (object)["id"=>$ret[0]['id']];
          // var_dump($user_id_s);exit;
          $identity->write($user_id_s);
      $this->fpS->user_name = $userNode['name'];

      $this->redirect('/user/home');
    }

    // public function logoutAction()
    // {
    //     // action body
    //     $authAdapter=Zend_Auth::getInstance();
    // 		$authAdapter->clearIdentity();
    // 		Zend_Session::namespaceUnset('facebook');
    // 		$this->redirect('/admin/login');
    // }

}
