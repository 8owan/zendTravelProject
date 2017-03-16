<?php

class Application_Model_User extends Zend_Db_Table_Abstract
{
  Protected $_name='user';

  function getAllUsers()
  {
    return $this->fetchAll()->toArray();
  }

  function getUserData($id)
  {
    return $this->find($id)->toArray()[0];
  }

  function blockUser($id,$Data)
  {
    $userData['user_name']=$Data['user_name'];
    $userData['password']=$Data['password'];
    $userData['email']=$Data['email'];
    $userData['type']='blocked';
    $this->update($userData,"id=$id");

  }

  function unblockUser($id,$Data)
  {
    $userData['user_name']=$Data['user_name'];
    $userData['password']=$Data['password'];
    $userData['email']=$Data['email'];
    $userData['type']='normal';
    $this->update($userData,"id=$id");
    
  }


}
