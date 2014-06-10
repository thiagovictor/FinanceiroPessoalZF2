<?php

namespace Financeiro\Controller;

use Zend\View\Model\ViewModel;
use Financeiro\Form\PermissaoForm;
use Zend\Form\Element;
use DoctrineORMModule\Form\Annotation\AnnotationBuilder as DoctrineAnnotationBuilder;
use DoctrineModule\Stdlib\Hydrator\DoctrineObject as DoctrineHydrator;

class PermissaoController extends AbstractCrudController {

    public function __construct() {
        $this->entity = 'Financeiro\Entity\Permissao';
        $this->route = 'FinanceiroAdmin';
        $this->service = 'Financeiro\Services\Permissao';
        $this->controller = 'permissoes';
        $this->form = 'Financeiro\Form\PermissaoForm';
    }

    public function newAction() {
        $form = $this->getServiceLocator()->get($this->form);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            $service = $this->getServiceLocator()->get($this->service);
            $service->inserir($request->getPost()->toArray());
            return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
        }
        return new ViewModel(array('form' => $form));
    }

    public function editAction() {
           
        /*
        $request = $this->getRequest();
        $repository = $this->getEM()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id', 0));
        if ($this->params()->fromRoute('id', 0)) {
            $array = $entity->toArray();
            
           $controllers = $this->getEM()->getRepository('Financeiro\Entity\Controlador');
           $arraycontrollers = $controllers->fatchCombo();
           $users = $this->getEM()->getRepository('Financeiro\Entity\User');
           $arrayusers = $users->fatchPairs();
           $acoes = $this->getEM()->getRepository('Financeiro\Entity\Acoes');
           $arrayacoes = $acoes->fatchCombo(array('controlador'=>$entity->getControlador()->getId()));
           $form = $this->getServiceLocator()->get($this->form);
           $form = new PermissaoForm($arrayusers, $arraycontrollers, $arrayacoes);
           $form->setData($array);
        }
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                $service->update($request->getPost()->toArray());
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        return new ViewModel(array('form' => $form));*/

        
       
        
        $repository = $this->getEM()->getRepository($this->entity);
        $form = $this->getServiceLocator()->get($this->form);
        $entity = $repository->find($this->params()->fromRoute('id', 0));
       
        //$form = $this->getServiceLocator()->get($this->form);
        
        $request = $this->getRequest();
        if ($this->params()->fromRoute('id', 0)) {
            $array = $entity->toArray();
            //print_r($entity->getAcoes()->getId());
            $form->setData($array);
        }
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                $service->update($request->getPost()->toArray());
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        return new ViewModel(array('form' => $form));
    }

}
