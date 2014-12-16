<?php

namespace Market;

use Market\Controller\IndexController;
use Zend\Loader\StandardAutoloader;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\Router\Http\Literal;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function getConfig()
    {
        return [
            'controllers' => [
                'invokables' => [
                    'market-index' => IndexController::class,
                ],
            ],

            'router' => [
                'routes' => [
                    'market' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/market',
                            'defaults' => [
                                'controller' => 'market-index',
                                'action'     => 'index',
                            ],
                        ],
                    ],
                ],
            ],

            'view_manager' => [
                'template_path_stack' => [
                    __DIR__ . '/view',
                ],
            ],
        ];
    }

    public function getAutoloaderConfig()
    {
        return [
            StandardAutoloader::class => [
                'namespaces' => [
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ],
            ],
        ];
    }
}
