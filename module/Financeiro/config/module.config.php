<?php
namespace Financeiro;

return array(
    'router' => array(
        'routes' => array(
            'Financeiro-edit' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/user/[:controller[/:action][/:id]]',
                    'constraints' => array (
                        'id' =>'[0-9]+'
                    ),
                ),
            ),
            'FinanceiroAdmin-edit' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/admin/[:controller[/:action][/:id]]',
                    'constraints' => array (
                        'id' =>'[0-9]+'
                    ),
                ),
            ),
            'Financeiro' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/user/[:controller[/:action][/page/:page]]',
                    'defaults' => array(
                        'action'     => 'index',
                        'page' => 1
                    ),
                ),
            ),
            'FinanceiroAdmin' => array(
                'type' => 'segment',
                'options' => array(
                    'route'    => '/admin/[:controller[/:action][/page/:page]]',
                    'defaults' => array(
                        'action'     => 'index',
                        'page' => 1
                    ),
                ),
            ),
        ),
    ),
    'controllers' => array(
        'invokables' => array(
            'centrocusto' => 'Financeiro\Controller\CentrocustoController',
            'cartegoria' =>  'Financeiro\Controller\CartegoriaController',
            'ativo' =>  'Financeiro\Controller\AtivoController',
            'user' =>  'Financeiro\Controller\UserController',
            'auth' => 'Financeiro\Controller\AuthController',
            'modulos' => 'Financeiro\Controller\ControladorController',
            'acoes' => 'Financeiro\Controller\AcoesController',
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
            'financeiro/centrocusto/index' => __DIR__ . '/../view/financeiro/centrocusto/index.phtml',
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
