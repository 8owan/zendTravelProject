<?php

class Bootstrap extends Zend_Application_Bootstrap_Bootstrap
{
    function _initViewHelpers()
    {
        $view = new Zend_View();
//ZendX_JQuery_View_Helper_JQuery::enableNoConflictMode();
        ZendX_JQuery::enableView($view);

        $viewRenderer = new Zend_Controller_Action_Helper_ViewRenderer();
        $viewRenderer->setView($view);
        Zend_Controller_Action_HelperBroker::addHelper($viewRenderer);

        $this->bootstrap('layout');
        $layout = $this->getResource('layout');
        $view = $layout->getView();

        //ZendX_JQuery::enableView($view);

        $view->doctype('HTML5');
        $view->headMeta()->appendHttpEquiv('Content-Type', 'text/html;charset=utf-8');
        $view->headTitle()->setSeparator(' - ');
        $view->headTitle('ZendTravelProject');
    }

}

