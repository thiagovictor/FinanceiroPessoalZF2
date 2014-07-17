<?php

namespace Financeiro\Controller;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;
use Zend\View\Model\ViewModel;
use Zend\Stdlib\Hydrator\ClassMethods;

class ContaController extends AbstractCrudController {

    public function __construct() {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro"));
        if ($auth->hasIdentity()) {
            $this->where = array('user' => $auth->getIdentity()->getId());
        } else {
            $this->where = array('user' => 0);
        }
        $this->entity = 'Financeiro\Entity\Conta';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\Conta';
        $this->controller = 'contas';
        $this->form = 'Financeiro\Form\ContaForm';
    }
    
    public function editAction() 
    {
        $form = new $this->form();
        $request = $this->getRequest();
        $repository = $this->getEM()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id', 0));
        if($this->params()->fromRoute('id', 0)){
            $entityForm = (new ClassMethods())->extract($entity);
            $entityForm["saldo"] = number_format($entityForm["saldo"], 2, ',', '.');
            $form->setData($entityForm);
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
