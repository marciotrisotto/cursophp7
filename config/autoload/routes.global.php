<?php 

use CodeEmailMKT\Application\Action\Customer;
//use CodeEmailMKT\Application\Action\Customer\CustomerListPageAction;
//use CodeEmailMKT\Application\Action\Customer\Factory\CustomerListPageFactory;
//use CodeEmailMKT\Application\Action\Customer\CustomerCreatePageAction;
//use CodeEmailMKT\Application\Action\Customer\Factory\CustomerCreatePageFactory;

return [
    'dependencies' => [
        'invokables' => [
            Zend\Expressive\Router\RouterInterface::class => Zend\Expressive\Router\AuraRouter::class,
            CodeEmailMKT\Application\Action\PingAction::class => CodeEmailMKT\Application\Action\PingAction::class,
        ],
        'factories' => [
            CodeEmailMKT\Application\Action\HomePageAction::class => CodeEmailMKT\Application\Action\HomePageFactory::class,
            CodeEmailMKT\Application\Action\TestePageAction::class => CodeEmailMKT\Application\Action\TestePageFactory::class,
			Customer\CustomerListPageAction::class => Customer\Factory\CustomerListPageFactory::class,
			Customer\CustomerCreatePageAction::class => Customer\Factory\CustomerCreatePageFactory::class,
			Customer\CustomerUpdatePageAction::class => Customer\Factory\CustomerUpdatePageFactory::class
        ],
    ],

    'routes' => [
        [
            'name' => 'home',
            'path' => '/',
            'middleware' => CodeEmailMKT\Application\Action\HomePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'api.ping',
            'path' => '/api/ping',
            'middleware' => CodeEmailMKT\Application\Action\PingAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'teste',
            'path' => '/teste',
            'middleware' => CodeEmailMKT\Application\Action\TestePageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'customer.list',
            'path' => '/admin/customer',
            'middleware' => Customer\CustomerListPageAction::class,
            'allowed_methods' => ['GET'],
        ],
        [
            'name' => 'customer.create',
            'path' => '/admin/customer/create',
            'middleware' => Customer\CustomerCreatePageAction::class,
            'allowed_methods' => ['GET','POST'],
        ],	
        [
            'name' => 'customer.update',
            'path' => '/admin/customer/update/{id}',
            'middleware' => Customer\CustomerUpdatePageAction::class,
            'allowed_methods' => ['GET','POST'],
			'options' => [
				'tokens' => [
					'id' => '\d+'
				]
			]
        ],								
    ],
];