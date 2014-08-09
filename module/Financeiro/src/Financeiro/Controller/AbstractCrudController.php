<?php

namespace Financeiro\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Stdlib\Hydrator\ClassMethods;

abstract class AbstractCrudController extends AbstractActionController {

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

    public function getLista() {
        $repo = $this->getEM()->getRepository($this->entity);
        return $repo->findAll();
    }

    public function getForm() {
        return new $this->form();
    }

    public function getService() {
        return $this->getServiceLocator()->get($this->service);
    }

    public function getSession() {
        return new \Zend\Authentication\Storage\Session("Financeiro");
    }

    public function getAuthentication() {
        $auth = new \Zend\Authentication\AuthenticationService();
        return $auth->setStorage($this->getSession());
    }

    public function indexAction() {
        $lista = $this->getLista();
        $count = 12;
        $page = $this->params()->fromRoute('page');
        $paginator = new Paginator(new ArrayAdapter($lista));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage($count);
        return new ViewModel(array('lista' => $paginator, 'page' => $page));
    }

    public function newAction() {
        $form = $this->getForm();
        $request = $this->getRequest();
        if ($request->isPost()) {
            $post = array_merge_recursive(
                    $request->getPost()->toArray(),
                    $request->getFiles()->toArray()
            );
            $form->setData($post);
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                $service->inserir($form->getData());
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function editAction() {
        $form = $this->getForm();
        $service = $this->getService();
        $request = $this->getRequest();
        $id = $this->params()->fromRoute('id', 0);

        if ($id) {
            if ($service->validarDono($id)) {
                $repository = $this->getEM()->getRepository($this->entity);
                $entity = $repository->find($id);
                $form->setData($service->ajustar((new ClassMethods())->extract($entity)));
            } else {
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        if ($request->isPost()) {
            $post = $request->getPost();
            if (!$service->validarDono($post["id"])) {
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service->update($form->getData());
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function deleteAction() {
        $service = $this->getServiceLocator()->get($this->service);
        $service->delete($this->params()->fromRoute('id', 0));
        return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
    }

    public function getEM() {
        if (null === $this->entityManager) {
            $this->entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->entityManager;
    }

}
