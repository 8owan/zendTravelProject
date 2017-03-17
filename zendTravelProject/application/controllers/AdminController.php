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

    public function addsightAction()
    {

        $sightForm = new Application_Form_Sights();
        $request = $this->getRequest();
        if($request->isPost()){
            if($sightForm->isValid($request->getPost())){
                $sight_model = new Application_Model_Sights();
                $sight_model->addSight($request->getParams());
                $this->redirect('/admin/addsight');
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
                $this->redirect('/admin/listsights');
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
        $this->redirect("/admin/listsights");

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
                $this->redirect('/admin/add-city');
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
        $this->redirect("/admin/list-city");
    }

    public function cityDetailsAction()
    {
        // action body
        $city_model=new Application_Model_City();
        $city_id=$this->_request->getParam("uid");
        $city=$city_model->cityDetails($city_id);
        $this->view->city=$city[0];
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
                $this->redirect('/admin/list-city ');
            }
        }
    }


}





















