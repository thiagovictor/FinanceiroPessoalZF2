<?php

namespace Financeiro\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;


abstract class AbstractCrudController extends AbstractActionController
{
    /**
     * 
     * @var EntityManager
     */
    protected $entityManager;
    protected $entity;
    protected $service;
    protected $form;
    protected $controller;
    protected $route;
    
    public function indexAction()
    {
        
        $repo = $this->getEM()->getRepository($this->entity);
        $listaCentroCusto = $repo->findAll();
        
        $count = 12;
        $page = $this->params()->fromRoute('page');
        $paginator = new Paginator(new ArrayAdapter($listaCentroCusto));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage($count);
        return new ViewModel(array('centrosdecusto' => $paginator, 'page'=>$page));
    }
    
    public function newAction()
    {   
        $form = new $this->form();
        $request = $this->getRequest();
        if($request->isPost()){
            $form->setData($request->getPost());
            if($form->isValid()){
               $service = $this->getServiceLocator()->get($this->service);
               $service->inserir($request->getPost()->toArray());
               return $this->redirect()->toRoute($this->route, array('controller'=> $this->controller));
            }
        }
        return new ViewModel(array('form'=> $form));
    }
    public function editAction() 
    {
        $form = new $this->form();
        $request = $this->getRequest();
        $repository = $this->getEM()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id', 0));
        if($this->params()->fromRoute('id', 0)){
            $form->setData($entity->toArray());
        }
        if($request->isPost()){
            $form->setData($request->getPost());
            if($form->isValid()){
               $service = $this->getServiceLocator()->get($this->service);
               $service->update($request->getPost()->toArray());
               return $this->redirect()->toRoute($this->route, array('controller'=>$this->controller)); 
            }
        }
        return new ViewModel(array('form'=> $form));
    }
    public function deleteAction(){
         $service = $this->getServiceLocator()->get($this->service);
         if($service->delete($this->params()->fromRoute('id', 0))){
              return $this->redirect()->toRoute($this->route, array('controller'=>$this->controller)); 
         }
    }


    public function getEM()
    {
        if (null === $this->entityManager){
            $this->entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->entityManager;
    }
}
