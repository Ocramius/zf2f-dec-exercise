<?php

namespace BlogModuleTest;

use PHPUnit_Framework_TestCase;
use Zend\Stdlib\DispatchableInterface;
use Zend\Test\Util\ModuleLoader;

class ModuleFunctionalTest extends PHPUnit_Framework_TestCase
{
    /**
     * @var \Zend\ServiceManager\ServiceManager
     */
    private $serviceManager;

    protected function setUp()
    {
        $moduleLoader = new ModuleLoader([
            'modules' => [
                'BlogModule',
            ],
            'module_listener_options' => [
                'module_paths' => [],
                'config_glob_paths' => [],
            ],
        ]);

        $this->serviceManager = $moduleLoader->getServiceManager();
    }

    public function testDefinedServiceTypes()
    {
        $this->assertInternalType(
            'array',
            $this->serviceManager->get('blog-tags')
        );
    }

    public function testDefinedControllers()
    {
        /* @var $controllerManager \Zend\ServiceManager\AbstractPluginManager */
        $controllerManager = $this->serviceManager->get('ControllerManager');

        $this->assertInstanceOf(
            DispatchableInterface::class,
            $controllerManager->get('blog-post-controller')
        );
    }
}
