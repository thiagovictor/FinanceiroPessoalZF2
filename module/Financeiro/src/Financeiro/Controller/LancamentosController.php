<?php

namespace Financeiro\Controller;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;


class LancamentosController extends AbstractCrudController
{
    public function __construct() {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro")); 
        if ($auth->hasIdentity()){
            $this->where = array('user'=>$auth->getIdentity()->getId());
        }else{
            $this->where = array('user'=>0);
        }
        $this->entity = 'Financeiro\Entity\Lancamentos';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\Lancamentos';
        $this->controller = 'lancamentos';
        $this->form = 'Financeiro\Form\LancamentosForm';
        
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
