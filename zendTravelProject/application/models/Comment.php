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
        $sql = $this->select()->from(array('u' => 'user'),
            array('u.id','u.user_name', 'u.image' , 'c.content'))
            ->join(array('c' => 'comment'),
                'u.id = c.user_id')->setIntegrityCheck(false);
        $query = $sql->query();
        $result = $query->fetchAll();
        return $result;
    }

}

