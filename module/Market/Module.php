<?php

namespace Market;

use Market\Controller\IndexController;
use Market\Controller\ViewController;
use Market\Factory\CategoryFactory;
use Market\Factory\Controller\PostControllerFactory;
use Market\Factory\Form\PostFormFilterFactory;
use Market\Form\PostFormFilter;
use Zend\Loader\StandardAutoloader;
use Zend\ModuleManager\Feature\AutoloaderProviderInterface;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\Router\Http\Literal;
use Zend\Mvc\Router\Http\Segment;

class Module implements AutoloaderProviderInterface, ConfigProviderInterface
{
    public function getConfig()
    {
        return [
            'service_manager' => [
                'factories' => [
                    'categories'          => CategoryFactory::class,
                    PostFormFilter::class => PostFormFilterFactory::class,
                ],
            ],
            'controllers' => [
                'invokables' => [
                    'market-index'         => IndexController::class,
                    'market-category-view' => ViewController::class,
                ],
                'factories' => [
                    'market-category-post' => PostControllerFactory::class,
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
                        'may_terminate' => true,
                        'child_routes' => array(
                            'category' => array(
                                'type'    => Literal::class,
                                'options' => array(
                                    'route'    => '/category',
                                    'defaults' => array(
                                        'controller' => 'market-category-view',
                                    ),
                                ),
                                'may_terminate' => true,
                                'child_routes' => array(
                                    'item' => array(
                                        'type'    => Literal::class,
                                        'options' => array(
                                            'route'    => '/item',
                                            'defaults' => array(
                                                'action' => 'item',
                                            ),
                                        ),
                                    ),
                                    'post' => array(
                                        'type'    => Literal::class,
                                        'options' => array(
                                            'route'    => '/post',
                                            'defaults' => array(
                                                'controller' => 'market-category-post',
                                            ),
                                        ),
                                    ),
                                ),
                            ),
                        ),
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
