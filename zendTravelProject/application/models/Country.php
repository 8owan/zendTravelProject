<?php

class Application_Model_Country extends Zend_Db_Table_Abstract
{
  protected $_name = 'country';

  function allCountries()
  	{
  		return $this->fetchAll()->toArray();
  	}
///////////// Delete country ////////////////////////////
	function deleteCountry($id)
  	{
  		$this->delete("id=$id");
  	}
///////////// Add country ////////////////////////////
  function addCountry($countryData)
  	{
  		$row = $this->createRow();
  		$row ->country_name = $countryData['country_name'];
  		$row ->save();
  	}
///////////// Update country ////////////////////////////
  function updateCountry($id,$countryData)
  	{
  		$country_data['country_name'] = $countryData['country_name'];

  		$this->update($country_data,"id=$id");

  	}
}

class Application_Model_City extends Zend_Db_Table_Abstract
{
    protected $_name = 'city';

}
