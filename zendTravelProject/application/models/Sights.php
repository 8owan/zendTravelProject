<?php

class Application_Model_Sights extends Zend_Db_Table_Abstract
{
    protected $_name = 'sights';
    function addSight($sightData){
        $row = $this->createRow();
        $row->sight_name = $sightData['sight_name'];
        $row->city_id = $sightData['city'];
        $row->save();
    }
    function editSight($id,$sightData){
        $sightUpdatedData['sight_name'] = $sightData['sight_name'];
        $sightUpdatedData['city_id'] = $sightData['city'];
        $this->update($sightUpdatedData,"id=$id");

    }
    function listSights()
    {
        return $this->fetchAll()->toArray();
    }
    function deleteSight($id)
    {
        $this->delete("id=$id");
    }
    function sightDetails($id)
    {
        return $this->find($id)->toArray();
    }
    function sightsInSpeceficCity($cityId){
        return $this->fetchAll("city_id = $cityId")->toArray();
    }

}

