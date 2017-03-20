<?php

class Application_Model_Experience extends Zend_Db_Table_Abstract
{


	protected $_name='experience';



	function addExperience($experienceData,$user_id){


		 $row=$this->createRow();

        $row->user_id=$user_id;
        $row->city_id=$experienceData['city_id'];
        $row->title=$experienceData['title'];
        $row->photo=$experienceData['photo'];
        $row->description=$experienceData['description'];

        $row->save();
	}
	function deleteExperience($id){
		$this->delete("id=$id");
	}
	function listExperience(){
		return $this->fetchAll()->toArray();
	}
	function updateExperience($id,$experienceData){

		$experience_data['title']=$experienceData['title'];
		$experience_data['photo']=$experienceData['photo'];
		$experience_data['description']=$experienceData['description'];

		// $experience_data['city_id']=$experienceData['city_id'];
		$this->update($experience_data,"id=$id ");
	}
	function experienceDetails($id)
	{
			return $this->find($id)->toArray();
	
	}
}