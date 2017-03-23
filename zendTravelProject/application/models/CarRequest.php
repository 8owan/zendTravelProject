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
    function getCarReq($user_id)
    {
      $sql = $this->select()->from(array('sight' => 'sights'),
          array('cReq.id','cReq.start_date', 'cReq.end_date' , 'sight.sight_name'))
          ->join(array('cReq' => 'car_request'),
              'cReq.sight_id = sight.id')->setIntegrityCheck(false);
        $query = $sql->query();
        $result = $query->fetchAll();
        return $result;
    }

}
