<?php

class CountryController extends Zend_Controller_Action
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

    public function displaycitiesAction()
    {
        // action body
  		$cities_model = new Application_Model_City();
  		$co_id = $this->_request->getParam("coid");
  		$cities = $cities_model->getCities($co_id);
      $this->view->co_id=$co_id;
  		$this->view->cities = $cities;
      // var_dump($cities);
      // die();

    }

    public function showcountriesAction()
    {
      $country_model = new Application_Model_Country();
      $this->view->countries = $country_model->allCountries();
    }

    public function cityAction()
    {
        // action body
        $cityId = $this->_request->getParam("cid");
        $cityModel = new Application_Model_City();
        $cityData = $cityModel->cityDetails($cityId);
        $this->view->cityData = $cityData;

        $sightsModel = new Application_Model_Sights();
        $sightsData = $sightsModel->sightsInSpeceficCity($cityId);
        $this->view->sightsInCity = $sightsData;


        // list experiences and comments in each city

        $experience_model = new Application_Model_Experience();
        $expInCity = $experience_model->expInSpeceficCity($cityId);
        $this->view->experience = $expInCity;

        //getting exp_id
        if($this->_request->getParam("exp_id")){
            $experience_id = $this->_requexpInSpeceficCityest->getParam("exp_id");
        }
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


}


