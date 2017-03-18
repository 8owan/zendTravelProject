<?php

class Application_Model_CarRequest extends Zend_Db_Table_Abstract
{
  protected $_name = 'car_request';
    function addCarRequest($carRequestData){
        $row = $this->createRow();
        $row->sight_id = $carRequestData['sightId'];
        $row->start_date = $carRequestData['startDate'];
        $row->end_date = $carRequestData['endDate'];
        $row->save();
    }
    function editSight($id,$sightData){
        $sightUpdatedData['sight_name'] = $sightData['sightName'];
        $sightUpdatedData['city_id'] = $sightData['city'];
        $this->update($sightUpdatedData,"id=$id");

    }
    function listRequests()
    {
        return $this->fetchAll()->toArray();
    }
    function deleteRequest($id)
    {
        $this->delete("id=$id");
    }
    function requestDetails($id)
    {
        return $this->find($id)->toArray();
    }

}

