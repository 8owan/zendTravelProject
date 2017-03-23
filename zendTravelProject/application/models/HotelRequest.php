<?php

class Application_Model_HotelRequest extends Zend_Db_Table_Abstract
{

protected $_name = 'hotel_request';

    function addHotelRequest($HotelData)
    {
    		$row = $this->createRow();
			$row->start_date=$HotelData['start_date'];
			$row->end_date=$HotelData['end_date'];
			$row->no_of_rooms=$HotelData['no_of_rooms'];
			$row->hotel_id=$HotelData['hotel_id'];
			$row->save();

    }

	function listHotel()
	 {

	 	return $this->fetchAll()->toArray();
	 }
	 function hotelDetails($id)
	{
		return $this->find($id)->toArray();
	}
  function getHotelReq($user_id)
  {
    $sql = $this->select()->from(array('h' => 'hotels'),
        array('hReq.id','hReq.start_date', 'hReq.end_date' , 'h.hotel_name'))
        ->join(array('hReq' => 'hotel_request'),
            'hReq.hotel_id = h.id')->setIntegrityCheck(false);
      $query = $sql->query();
      $result = $query->fetchAll();
      return $result;
  }

}
