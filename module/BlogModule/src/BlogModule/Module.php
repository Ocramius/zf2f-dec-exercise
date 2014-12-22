<?php

namespace BlogModule;

use BlogModule\Controller\BlogPostController;
use Zend\ModuleManager\Feature\ConfigProviderInterface;
use Zend\Mvc\Router\Http\Literal;
use Zend\Mvc\Router\Http\Segment;

class Module implements ConfigProviderInterface
{
    /**
     * {@inheritDoc}
     */
    public function getConfig()
    {
        return [
            'service_manager' => [
                'services' => [
                    'blog-tags' => [
                        'programming',
                        'php',
                        'zf2',
                        'course',
                    ],
                ],
            ],
            'controllers' => [
                'invokables' => [
                    'blog-post-controller' => BlogPostController::class,
                ],
            ],
            'router' => [
                'routes' => [
                    'blog' => [
                        'type' => Literal::class,
                        'options' => [
                            'route'    => '/blog',
                        ],
                        'may_terminate' => false,
                        'child_routes' => [
                            'post' => [
                                'type'    => Segment::class,
                                'options' => [
                                    'route'    => '/:blogPostId',
                                    'constraints' => [
                                        'blogPostId' => '\d+',
                                    ],
                                    'defaults' => [
                                        'controller' => 'blog-post-controller',
                                        'action'     => 'index',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
            'view_manager' => [
                'display_not_found_reason' => true,
                'display_exceptions'       => true,
                'doctype'                  => 'HTML5',
                'template_path_stack' => [
                    __DIR__ . '/../../view',
                ],
            ],
        ];
    }
}
