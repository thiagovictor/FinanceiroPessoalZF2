<?php

namespace Financeiro\Controller;

class CentrocustoController extends AbstractCrudController {

    public function __construct() {
        $this->entity = 'Financeiro\Entity\Centrocusto';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\Centrocusto';
        $this->controller = 'centrocusto';
        $this->form = 'Financeiro\Form\CentrocustoForm';
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
}
