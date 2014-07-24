<?php

namespace Financeiro\Controller;

use Zend\View\Model\ViewModel;

class CartegoriaController extends AbstractCrudController {

    public function __construct() {
        $this->entity = 'Financeiro\Entity\Cartegoria';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\Cartegoria';
        $this->controller = 'cartegoria';
        $this->form = 'Financeiro\Form\CartegoriaForm';
    }

    public function getLista() {
        $repo = $this->getEM()->getRepository($this->entity);
        if ($this->getAuthentication()->hasIdentity()) {
            return $repo->findBy(array(
                        'user' => $this->getAuthentication()->getIdentity()->getId()
            ));
        } else {
            return array();
        }
    }

    public function getForm() {
        return $this->getServiceLocator()->get($this->form);
    }

    public function listcartegoriasAction() {
        $repo = $this->getEM()->getRepository($this->entity);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $id = $request->getPost()["centrocusto"];
            $cartegoria = $request->getPost()["cartegoria"];
        } else {
            $id = "";
            $cartegoria = "";
        }
        $lista = $repo->findBy(array('centrocusto' => $id), array('descricao' => 'ASC'));
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariables(array('lista' => $lista, 'cartegoria' => $cartegoria, 'centrocusto' => $id, 'array' => $request->getPost()->toArray()));
        return $viewModel;
    }

}
