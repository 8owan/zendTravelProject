<?php

class Application_Model_HotelRequest extends Zend_Db_Table_Abstract
{

protected $_name = 'hotel_request';

    function addHotelRequest($HotelData)
    {
    	$row = $this->createRow();
      $row->user_id=$HotelData['user_id'];
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
            'hReq.hotel_id = h.id')
            ->where("user_id=$user_id")
            ->setIntegrityCheck(false);
      $query = $sql->query();
     $result = $query->fetchAll();
      return $result;
  }
  function updateRequest($hotel_id){
    // $hotel_request=new Application_Model_Hotel()
  $sql=$this->select()
            ->from(array('H' => 'hotels' ), array('H.id' ,'H.avail_room'))
            ->join(array('Hr'=>'hotel_request'),'Hr.hotel_id=H.id ')
            ->update('hotels','H.avail_room=H.avail_room-Hr.no_of_rooms','H.id=$hotel_id')
             ->setIntegrityCheck(false);
                $query = $sql->query();
     $result = $query->fetchAll();
      return $result;


  }

}
