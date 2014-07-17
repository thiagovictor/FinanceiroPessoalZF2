<?php

namespace Financeiro\Controller;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\Hydrator\ClassMethods;


class UserController extends AbstractCrudController
{
    public function __construct() {
        $this->entity = 'Financeiro\Entity\User';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\User';
        $this->controller = 'user';
        $this->form = 'Financeiro\Form\UserForm';
    }
    public function newAction()
    {   
        $form = $this->getServiceLocator()->get($this->form);
        $request = $this->getRequest();
        if($request->isPost()){
            $form->setData($request->getPost());
            if($form->isValid()){
               $service = $this->getServiceLocator()->get($this->service);
               $service->inserir($form->getData());
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
            $array = (new ClassMethods())->extract($entity);
            unset($array['password']);
            $form->setData($array);
        }
        if($request->isPost()){
            $form->setData($request->getPost());
            if($form->isValid()){
               $service = $this->getServiceLocator()->get($this->service);
               $service->update($form->getData());
               return $this->redirect()->toRoute($this->route, array('controller'=>$this->controller)); 
            }
        }
        return new ViewModel(array('form'=> $form));
    }
}
