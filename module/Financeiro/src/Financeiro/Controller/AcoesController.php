<?php

namespace Financeiro\Controller;

use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class AcoesController extends AbstractCrudController
{
    public function __construct() {
        $this->entity = 'Financeiro\Entity\Acoes';
        $this->route = 'FinanceiroAdmin';
        $this->service = 'Financeiro\Services\Acoes';
        $this->controller = 'acoes';
        $this->form = 'Financeiro\Form\AcoesForm';
    }
     public function indexAction()
    {
        
        $repo = $this->getEM()->getRepository($this->entity);
        $lista = $repo->findBy( array(), array('controlador' => 'ASC') );
        
        $count = 12;
        $page = $this->params()->fromRoute('page');
        $paginator = new Paginator(new ArrayAdapter($lista));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage($count);
        return new ViewModel(array('lista' => $paginator, 'page'=>$page));
    }
    
    public function newAction()
    {   
        $form = $this->getServiceLocator()->get($this->form);
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
        $form = $this->getServiceLocator()->get($this->form);
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
}
