<?php

class Application_Model_City extends Zend_Db_Table_Abstract
{
    protected $_name='city';

    function listCity()
    {

        return $this->fetchAll()->toArray();
    }
    function addCity($CityData){
        $row=$this->createRow();
        $row->id=$CityData['id'];
        $row->city_name=$CityData['city_name'];
        $row->country_id=$CityData['country_id'];
        $row->save();

    }
    function deleteCity($id){
        $this->delete("id=$id");

    }

    function cityDetails($id){
        return $this->find($id)->toArray();
    }
    function updateCity($id){
        $city_data['id']=$CityData['id'];
        $city_data['city_name']=$CityData['city_name'];
        $city_data['country_id']=$CityData['country_id'];

        $this->update($city_data,"id=$id");


    }

}

