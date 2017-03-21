<?php

class Application_Model_Experience extends Zend_Db_Table_Abstract
{
  protected $_name='experience';

  function getTopExperience($allCitys)
  {
    foreach ($allCitys as $key => $value) {
      $citysID[$key]=$value['id'];
    }

    foreach ($citysID as $city_id) {
      $rows=$this->fetchAll("city_id=$city_id")->toArray();
      $number[$city_id]=count($rows);
    }
    arsort($number);
    return $number;
  }
}
