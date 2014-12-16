<?php
return array(
    'controllers' => array(
    	'invokables' => array(
            // test controller has no dependencies
    		'search-test-controller' => 'Search\Controller\TestController',
    	),
        'factories' => array(
        	// search controller depends on the database
            'search-controller' => 'Search\Factory\SearchControllerFactory',
        ),
    ),
	'service_manager' => array(
		'invokables' => array(
			'search-form' => 'Search\Form\SearchForm',
			'search-form-filter' => 'Search\Form\SearchFormFilter',
		),
		'factories' => array(
			'search-listings-table' => 'Search\Factory\ListingsTableFactory',
		),
	),
    'router' => array(
        'routes' => array(
            'search-home' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/search',
                    'defaults' => array(
                        'controller'    => 'search-controller',
                        'action'        => 'index',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '/[:action]',
                            'constraints' => array(
                                'action'     => '[a-zA-Z][a-zA-Z0-9_-]*',
                            ),
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
            'search-list' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/search/list',
                    'defaults' => array(
                        'controller'    => 'search-controller',
                        'action'        => 'list',
                    ),
                ),
                'may_terminate' => true,
                'child_routes' => array(
                    'default' => array(
                        'type'    => 'Segment',
                        'options' => array(
                            'route'    => '[/]',
                            'defaults' => array(
                            ),
                        ),
                    ),
                ),
            ),
        	// used to test that the controller shows up
            'search-test' => array(
                'type'    => 'Literal',
                'options' => array(
                    'route'    => '/search/test',
                    'defaults' => array(
                        'controller'    => 'search-test-controller',
                        'action'        => 'index',
                    ),
                ),
            ),
        ),
    ),
    'view_manager' => array(
        'template_path_stack' => array(
            'Search' => __DIR__ . '/../view',
        ),
    ),
);
