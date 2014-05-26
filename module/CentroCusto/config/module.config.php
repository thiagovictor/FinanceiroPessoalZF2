<?php
namespace CentroCusto;

return array(
    'router' => array(
        'routes' => array(
            'CentroCusto' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/admin/[:controller[/:action][/page/:page]]',
                    'defaults' => array(
                        'action'     => 'index',
                        //'controller' => 'centrocusto',
                        'page' => 1
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'centrocusto' => 'CentroCusto\Controller\IndexController'
        ),
    ),
    'view_manager' => array(
        'display_not_found_reason' => true,
        'display_exceptions'       => true,
        'doctype'                  => 'HTML5',
        'not_found_template'       => 'error/404',
        'exception_template'       => 'error/index',
        'template_map' => array(
            'layout/layout'           => __DIR__ . '/../view/layout/layout.phtml',
            'centro-custo/index/index' => __DIR__ . '/../view/centro-custo/index/index.phtml',
            'error/404'               => __DIR__ . '/../view/error/404.phtml',
            'error/index'             => __DIR__ . '/../view/error/index.phtml',
        ),
        'template_path_stack' => array(
            __DIR__ . '/../view',
        ),
    ),
    // Placeholder for console routes
    'console' => array(
        'router' => array(
            'routes' => array(
            ),
        ),
    ),
     'doctrine' => array(
        'driver' => array(
            __NAMESPACE__.'_driver' => array(
                'class' => 'Doctrine\ORM\Mapping\Driver\AnnotationDriver',
                'cache' => 'array',
                'paths' => array(
                    __DIR__.'/../src/'.__NAMESPACE__.'/Entity'
                ),
            ),
            'orm_default' => array(
                'drivers' => array(
                        __NAMESPACE__.'\Entity' => __NAMESPACE__.'_driver'
                ),
            ),
        ),
    ),
);
