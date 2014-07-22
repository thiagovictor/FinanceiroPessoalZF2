<?php

namespace Financeiro\Controller;

use Zend\View\Model\ViewModel;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Paginator\Paginator,
 Zend\Paginator\Adapter\ArrayAdapter;

class LancamentosController extends AbstractCrudController {

    public function __construct() {

        $this->entity = 'Financeiro\Entity\Lancamentos';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\Lancamentos';
        $this->controller = 'lancamentos';
        $this->form = 'Financeiro\Form\LancamentosForm';
    }
    
    public function indexAction()
    {
        $repo = $this->getEM()->getRepository($this->entity);
        $lista = $repo->lancamentosGeralMes();
        $count = 12;
        $page = $this->params()->fromRoute('page');
        $paginator = new Paginator(new ArrayAdapter($lista));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage($count);
        return new ViewModel(array('lista' => $paginator, 'page'=>$page));
    }
    
    public function newAction() {
        $form = $this->getServiceLocator()->get($this->form);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                $service->inserir($form->getData());
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function editAction() {
        $service = $this->getServiceLocator()->get($this->service);
        $form = $this->getServiceLocator()->get($this->form);
        $request = $this->getRequest();
        $repository = $this->getEM()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id', 0));
        if ($this->params()->fromRoute('id', 0)) {
            $array = (new ClassMethods())->extract($entity);
            $arrayPronto = $service->ajustar($array);
            $form->setData($arrayPronto);
        }
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service->update($form->getData());
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        return new ViewModel(array('form' => $form));
    }

}
