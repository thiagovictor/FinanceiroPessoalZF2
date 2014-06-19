<?php

namespace Financeiro;

use Zend\Mvc\ModuleRouteListener;
use Zend\Mvc\MvcEvent;
use Financeiro\Services\Centrocusto;
use Financeiro\Services\Cartegoria;
use Financeiro\Services\Ativo;
use Financeiro\Services\User;
use Financeiro\Services\Acoes;
use Financeiro\Services\Conta;
use Financeiro\Services\Favorecido;
use Financeiro\Services\Cartao;
use Financeiro\Services\Permissao;
use Financeiro\Services\Controlador;
use Financeiro\Auth\Adapter;
use Financeiro\Form\CartegoriaForm;
use Financeiro\Form\UserForm;
use Financeiro\Form\AcoesForm;
use Financeiro\Form\PermissaoForm;
use Zend\ModuleManager\ModuleManager;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;


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
    
    public function init(ModuleManager $moduleManager) {
        $sharedEvents = $moduleManager->getEventManager()->getSharedManager();
        $sharedEvents->attach("Financeiro", 'dispatch', function($e) {
           $controller = $e->getTarget();
           $auth = new AuthenticationService;
           $auth->setStorage(new Session("Financeiro"));
                if(!$auth->hasIdentity())
                {
                    if($controller->getEvent()->getRouteMatch()->getParams()['controller'] !== 'auth'){
                         return $controller->redirect()->toRoute('FinanceiroAdmin' , array('controller'=>'auth'));
                    }
                }else
                {
                    //echo $auth->getIdentity()->getId();
                    //=> echo $matchedRoute = $controller->getEvent()->getRouteMatch()->getParams()['controller']."<br>";
                    //=> echo $matchedRoute = $controller->getEvent()->getRouteMatch()->getParams()['action'];
                }
        }, 99);
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
                'Financeiro\Services\Acoes' => function($service){
                    return new Acoes($service->get('Doctrine\ORM\EntityManager'));
                },
                'Financeiro\Services\Conta' => function($service){
                    return new Conta($service->get('Doctrine\ORM\EntityManager'));
                },
                'Financeiro\Services\Favorecido' => function($service){
                    return new Favorecido($service->get('Doctrine\ORM\EntityManager'));
                },
                'Financeiro\Services\Cartao' => function($service){
                    return new Cartao($service->get('Doctrine\ORM\EntityManager'));
                },
                'Financeiro\Auth\Adapter' => function($service){
                    return new Adapter($service->get('Doctrine\ORM\EntityManager'));
                },
                'Financeiro\Services\Controlador' => function($service){
                    return new Controlador($service->get('Doctrine\ORM\EntityManager'));
                },
                'Financeiro\Services\Permissao' => function($service){
                    return new Permissao($service->get('Doctrine\ORM\EntityManager'));
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
                },
                'Financeiro\Form\AcoesForm' => function($service){
                    $entityManager = $service->get('Doctrine\ORM\EntityManager');
                    $repository = $entityManager->getRepository('Financeiro\Entity\Controlador');
                    $arraycontrollers = $repository->fatchPairs();
                    return new AcoesForm($arraycontrollers);
                },
                'Financeiro\Form\PermissaoForm' => function($service){
                    $entityManager = $service->get('Doctrine\ORM\EntityManager');
                    
                    $controllers = $entityManager->getRepository('Financeiro\Entity\Controlador');
                    $arraycontrollers = $controllers->fatchPairs();
                    
                    $users = $entityManager->getRepository('Financeiro\Entity\User');
                    $arrayusers = $users->fatchPairs();
                    
                    $acoes = $entityManager->getRepository('Financeiro\Entity\Acoes');
                    $arrayacoes = $acoes->fatchPairs();
                    
                    return new PermissaoForm($arrayusers, $arraycontrollers, $arrayacoes);
                }
            )
        );
    }
}


