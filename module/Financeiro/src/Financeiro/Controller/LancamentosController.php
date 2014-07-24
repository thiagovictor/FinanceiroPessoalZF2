<?php

namespace Financeiro\Controller;

class LancamentosController extends AbstractCrudController {

    public function __construct() {

        $this->entity = 'Financeiro\Entity\Lancamentos';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\Lancamentos';
        $this->controller = 'lancamentos';
        $this->form = 'Financeiro\Form\LancamentosForm';
    }
    
    public function getLista() {
        $repo = $this->getEM()->getRepository($this->entity);
        return $repo->lancamentosGeralMes();
    }
    
    public function getForm() {
        return $this->getServiceLocator()->get($this->form);
    }
}