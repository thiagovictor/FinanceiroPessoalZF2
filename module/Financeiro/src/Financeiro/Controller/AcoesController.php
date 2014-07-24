<?php

namespace Financeiro\Controller;

use Zend\View\Model\ViewModel;

class AcoesController extends AbstractCrudController {

    public function __construct() {
        $this->entity = 'Financeiro\Entity\Acoes';
        $this->route = 'FinanceiroAdmin';
        $this->service = 'Financeiro\Services\Acoes';
        $this->controller = 'acoes';
        $this->form = 'Financeiro\Form\AcoesForm';
    }

    public function getLista() {
        $repo = $this->getEM()->getRepository($this->entity);
        return $repo->findBy(array(), array('controlador' => 'ASC'));
    }

    public function getForm() {
        return $this->getServiceLocator()->get($this->form);
    }

    public function listacoesAction() {
        $repo = $this->getEM()->getRepository($this->entity);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $id = $request->getPost()["controlador"];
            $idAcoes = $request->getPost()["acoes"];
        } else {
            $id = 0;
            $idAcoes = 0;
        }
        $lista = $repo->findBy(array('controlador' => $id), array('descricao' => 'ASC'));
        $viewModel = new ViewModel();
        $viewModel->setTerminal(true);
        $viewModel->setVariables(array('lista' => $lista, 'idAcoes' => $idAcoes));
        return $viewModel;
    }

}
