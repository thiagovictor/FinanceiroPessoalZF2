<?php
/**
 * Zend Framework (http://framework.zend.com/)
 *
 * @link      http://github.com/zendframework/ZendSkeletonApplication for the canonical source repository
 * @copyright Copyright (c) 2005-2014 Zend Technologies USA Inc. (http://www.zend.com)
 * @license   http://framework.zend.com/license/new-bsd New BSD License
 */

namespace Financeiro;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Financeiro\Services\Centrocusto;
use Financeiro\Services\Cartegoria;
use Financeiro\Services\Ativo;
use Financeiro\Services\User;
use Financeiro\Form\CartegoriaForm;
use Financeiro\Form\UserForm;
use Financeiro\Form\CentrocustoForm;

class Module
{
    public function onBootstrap(MvcEvent $e)
    {
        $eventManager        = $e->getApplication()->getEventManager();
        $moduleRouteListener = new ModuleRouteListener();
        $moduleRouteListener->attach($eventManager);
    }

    public function getConfig()
    {
        return include __DIR__ . '/config/module.config.php';
    }

    public function getAutoloaderConfig()
    {
        return array(
            'Zend\Loader\StandardAutoloader' => array(
                'namespaces' => array(
                    __NAMESPACE__ => __DIR__ . '/src/' . __NAMESPACE__,
                ),
            ),
        );
    }
    public function getServiceConfig()
    {
        return array(
            'factories' => array(
                'Financeiro\Services\Centrocusto' => function($service){
                    return new Centrocusto($service->get('Doctrine\ORM\EntityManager'));
                },
                'Financeiro\Services\Cartegoria' => function($service){
                    return new Cartegoria($service->get('Doctrine\ORM\EntityManager'));
                },
                'Financeiro\Services\Ativo' => function($service){
                    return new Ativo($service->get('Doctrine\ORM\EntityManager'));
                },
                'Financeiro\Services\User' => function($service){
                    return new User($service->get('Doctrine\ORM\EntityManager'));
                },
                'Financeiro\Form\CartegoriaForm' => function($service){
                    $entityManager = $service->get('Doctrine\ORM\EntityManager');
                    $repository = $entityManager->getRepository('Financeiro\Entity\Centrocusto');
                    $arraycentrocusto = $repository->fatchPairs();
                    return new CartegoriaForm($arraycentrocusto);
                },
                'Financeiro\Form\UserForm' => function($service){
                    $entityManager = $service->get('Doctrine\ORM\EntityManager');
                    $repository = $entityManager->getRepository('Financeiro\Entity\Ativo');
                    $arrayativo = $repository->fatchPairs();
                    return new UserForm($arrayativo);
                }
            )
        );
    }
}


