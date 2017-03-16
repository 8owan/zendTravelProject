<?php

class AdminControllerTest extends Zend_Test_PHPUnit_ControllerTestCase
{

    public function setUp()
    {
        $this->bootstrap = new Zend_Application(APPLICATION_ENV, APPLICATION_PATH . '/configs/application.ini');
        parent::setUp();
    }

    public function testIndexAction()
    {
        $params = array('action' => 'index', 'controller' => 'Admin', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        
        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        $this->assertQueryContentContains(
            'div#view-content p',
            'View script for controller <b>' . $params['controller'] . '</b> and script/action name <b>' . $params['action'] . '</b>'
            );
    }

<<<<<<< HEAD
    public function testAllAction()
    {
        $params = array('action' => 'all', 'controller' => 'Admin', 'module' => 'default');
=======
    public function testDetailsAction()
    {
        $params = array('action' => 'details', 'controller' => 'Admin', 'module' => 'default');
>>>>>>> 1ce84ce6d3d6c5c55409fd27a25c8897cab88f16
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        
        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        $this->assertQueryContentContains(
            'div#view-content p',
            'View script for controller <b>' . $params['controller'] . '</b> and script/action name <b>' . $params['action'] . '</b>'
            );
    }

<<<<<<< HEAD
    public function testDeleteAction()
    {
        $params = array('action' => 'delete', 'controller' => 'Admin', 'module' => 'default');
=======
    public function testListAction()
    {
        $params = array('action' => 'list', 'controller' => 'Admin', 'module' => 'default');
>>>>>>> 1ce84ce6d3d6c5c55409fd27a25c8897cab88f16
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        
        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        $this->assertQueryContentContains(
            'div#view-content p',
            'View script for controller <b>' . $params['controller'] . '</b> and script/action name <b>' . $params['action'] . '</b>'
            );
    }

<<<<<<< HEAD
    public function testUpdateAction()
    {
        $params = array('action' => 'update', 'controller' => 'Admin', 'module' => 'default');
=======
    public function testUserDetailsAction()
    {
        $params = array('action' => 'userDetails', 'controller' => 'Admin', 'module' => 'default');
>>>>>>> 1ce84ce6d3d6c5c55409fd27a25c8897cab88f16
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        
        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        $this->assertQueryContentContains(
            'div#view-content p',
            'View script for controller <b>' . $params['controller'] . '</b> and script/action name <b>' . $params['action'] . '</b>'
            );
    }

<<<<<<< HEAD
    public function testAddAction()
    {
        $params = array('action' => 'add', 'controller' => 'Admin', 'module' => 'default');
=======
    public function testUserListAction()
    {
        $params = array('action' => 'userList', 'controller' => 'Admin', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        
        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        $this->assertQueryContentContains(
            'div#view-content p',
            'View script for controller <b>' . $params['controller'] . '</b> and script/action name <b>' . $params['action'] . '</b>'
            );
    }

    public function testUserBlockAction()
    {
        $params = array('action' => 'userBlock', 'controller' => 'Admin', 'module' => 'default');
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        
        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        $this->assertQueryContentContains(
            'div#view-content p',
            'View script for controller <b>' . $params['controller'] . '</b> and script/action name <b>' . $params['action'] . '</b>'
            );
    }

    public function testUserUnblockAction()
    {
        $params = array('action' => 'userUnblock', 'controller' => 'Admin', 'module' => 'default');
>>>>>>> 1ce84ce6d3d6c5c55409fd27a25c8897cab88f16
        $urlParams = $this->urlizeOptions($params);
        $url = $this->url($urlParams);
        $this->dispatch($url);
        
        // assertions
        $this->assertModule($urlParams['module']);
        $this->assertController($urlParams['controller']);
        $this->assertAction($urlParams['action']);
        $this->assertQueryContentContains(
            'div#view-content p',
            'View script for controller <b>' . $params['controller'] . '</b> and script/action name <b>' . $params['action'] . '</b>'
            );
    }


}











<<<<<<< HEAD
=======




>>>>>>> 1ce84ce6d3d6c5c55409fd27a25c8897cab88f16
