<?php

namespace Financeiro\Controller;
use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;
use Zend\Stdlib\Hydrator\ClassMethods;


class CartegoriaController extends AbstractCrudController
{
    public function __construct() {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro")); 
        if ($auth->hasIdentity()){
            $this->where = array('user'=>$auth->getIdentity()->getId());
        }else{
            $this->where = array('user'=>0);
        }
        $this->entity = 'Financeiro\Entity\Cartegoria';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\Cartegoria';
        $this->controller = 'cartegoria';
        $this->form = 'Financeiro\Form\CartegoriaForm';
        
    }
    
    public function listcartegoriasAction() {
        $repo = $this->getEM()->getRepository($this->entity);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $id = $request->getPost()["centrocusto"];
            $idCartegorias = $request->getPost()["cartegoria"];
        } else {
            $id = "";
            $idCartegorias = "";
        }
        $lista = $repo->findBy(array('centrocusto' => $id), array('descricao' => 'ASC'));
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariables(array('lista' => $lista,'idcartegoria'=>$idCartegorias, 'idcentrocusto'=> $id));
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
            $form->setData((new ClassMethods())->extract($entity));
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
