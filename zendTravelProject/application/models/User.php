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
    $userData['image']=$Data['image'];
    $userData['type']='blocked';
    $this->update($userData,"id=$id");

  }

  function unblockUser($id,$Data)
  {
    $userData['user_name']=$Data['user_name'];
    $userData['password']=$Data['password'];
    $userData['email']=$Data['email'];
    $userData['image']=$Data['image'];
    $userData['type']='normal';
    $this->update($userData,"id=$id");

  }

  function makeAdminUser($id,$Data)
  {
    $userData['user_name']=$Data['user_name'];
    $userData['password']=$Data['password'];
    $userData['email']=$Data['email'];
    $userData['image']=$Data['image'];
    $userData['type']='admin';
    $this->update($userData,"id=$id");
  }

  function addNewUser($userData)
  {
    $row = $this->createRow();
    $row->user_name = $userData['user_name'];
    $row->password = $userData['password'];
    $row->email = $userData['email'];
    $row->image = $userData['image'];
    $row->type = 'normal';
    $row->save();
  }
  function editUserData($id,$userData)
  {
    $user_data['user_name'] = $userData['user_name'];
		$user_data['email'] = $userData['email'];
		$user_data['password'] = $userData['password'];
    $user_data['image'] = $userData['image'];
		$this->update($user_data,"id=$id");
  }
  function checkEmail($email)
  {
    $sql = $this->select()
    ->from(array('user'),array('id'))
    ->where("email='$email'")
    ->setIntegrityCheck(false);
    $result =$sql->query()->fetchAll();
    print_r( $result);
    //die();
    return $result;

    // return $this->find($email)->toArray();
  }


}
