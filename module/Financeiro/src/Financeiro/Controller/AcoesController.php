<?php

namespace Financeiro\Controller;

use Zend\View\Model\ViewModel;

class AcoesController extends AbstractCrudController
{
    public function __construct() {
        $this->entity = 'Financeiro\Entity\Acoes';
        $this->route = 'FinanceiroAdmin';
        $this->service = 'Financeiro\Services\Acoes';
        $this->controller = 'acoes';
        $this->form = 'Financeiro\Form\AcoesForm';
        $this->orderby = array('controlador' => 'ASC');
    }  
    
    public function listacoesAction()
    {
        $repo = $this->getEM()->getRepository($this->entity);
        $request = $this->getRequest();
        if($request->isPost()){
           $id = $request->getPost()["controlador"];
        }else{
            $id = 0;
        }
        $lista = $repo->findBy(array('controlador'=>$id),array('descricao'=>'ASC'));
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariables(array('lista' => $lista));
        return $viewModel;
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
