<?php

class Application_Form_Comment extends Zend_Form
{

    public function init()
    {
        /* Form Elements & Other Definitions Here ... */
        $expModel = new Application_Model_Experience();
        $maxId = $expModel->getMaxId();

        $this->setMethod('POST');
        //$this->form->setAction($this->url());
        $comment = new Zend_Form_Element_Text('Comment');
        $comment ->setAttribs(array('class'=>'form-control','placeholder'=>'Write Your Comment'));
        $comment->setRequired(true);

        $commentButton = new Zend_Form_Element_Submit('comment');
        $commentButton->setAttribs(array('class'=>'btn btn-success'))->setRequired(true);


        $this->addElements(array($comment,$commentButton));
    }


}

