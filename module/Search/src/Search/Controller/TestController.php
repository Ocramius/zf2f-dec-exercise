<?php
namespace Search\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class TestController extends AbstractActionController
{
	
	public function indexAction()
    {
        return new ViewModel(array(	'test' => 'TEST CONTROLLER'));
    }

}
