<?php

class Application_Model_Comment extends Zend_Db_Table_Abstract
{
    protected $_name = 'comment';
    function addComment($commentData,$user_id,$experience_id){
        $row = $this->createRow();
        $row->content = $commentData['Comment'];
        $row->user_id = $user_id;
        $row->experince_id = $experience_id;
        $row->save();
    }

    function listComments(){
        return $this->fetchAll()->toArray();
    }

    function deleteComment($id){
        $this->delete("id=$id");
    }

    function editComment($id,$commentData){
        $commentUpdatedData['content'] = $commentData['Comment'];
        $this->update($commentUpdatedData,"id=$id");

    }

    function commentDetails($id)
    {
        return $this->find($id)->toArray();
    }
    function allCommentsData()
    {
        $sql = $this->select()->from(array('c' => 'comment'), array('*'))
            ->joinLeft(array('u' => 'user'),'u.id = c.user_id', array('user_name', 'image', 'email', 'type'))
            ->setIntegrityCheck(false);
        $query = $sql->query();
        $result = $query->fetchAll();
//        echo "<pre>";
//        print_r($result);
//        die();
        return $result;
    }

}

