<?php

class Application_Model_Hotel extends Zend_Db_Table_Abstract
{
	protected $_name='hotels';



	 function deleteHotel($id)
	 {
	 	
	 	$this->delete("id=$id");
	 }
	 function listHotel()
	 {

	 	return $this->fetchAll()->toArray();
	 }

	 function addHotel($HotelData){
	 		$row = $this->createRow();
			$row->hotel_name = $HotelData['hotel_name'];
			$row->city_id = $HotelData['city_id'];
			$row->avail_room = $HotelData['avail_room'];
			// $row->id = $HotelData['id'];

			$row->save();
	 }
	function hotelDetails($id)
	{
		return $this->find($id)->toArray();
	}
	
	function  updateHotel($id,$HotelData){

		
		$hotel_data['city_id']=$HotelData['city_id'];
		// $hotel_data['id']=$HotelData['id'];
		$hotel_data['hotel_name']=$HotelData['hotel_name'];

		$hotel_data['avail_room']=$HotelData['avail_room'];
		$this->update($hotel_data,"id=$id");
		}
// 	function chooseHotel($id){

// 			 	return $this->fetchAll()->toArray();



// }
    function updateNoOfRooms($id,$noOfRooms){
        $sql = "Update hotels set avail_room = $noOfRooms   Where id = $id";
                    $query = $this->getDbTable()->getAdapter()->query($sql);
                    $query->execute();
    }
		
}