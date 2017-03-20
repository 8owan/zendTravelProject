<?php

class CountryController extends Zend_Controller_Action
{

    public function init()
    {
        /* Initialize action controller here */
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

}
