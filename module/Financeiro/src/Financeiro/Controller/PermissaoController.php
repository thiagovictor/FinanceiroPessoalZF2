<?php

namespace Financeiro\Controller;
use Zend\View\Model\ViewModel;


class PermissaoController extends AbstractCrudController
{
    public function __construct() {
        $this->entity = 'Financeiro\Entity\Permissao';
        $this->route = 'FinanceiroAdmin';
        $this->service = 'Financeiro\Services\Permissao';
        $this->controller = 'permissoes';
        $this->form = 'Financeiro\Form\PermissaoForm';
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
            $array = $entity->toArray();
            $form->setData($array);
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
