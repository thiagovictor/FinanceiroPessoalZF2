<?php

namespace Financeiro\Controller;

class CartaoController extends AbstractCrudController {

    public function __construct() {
        $this->entity = 'Financeiro\Entity\Cartao';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\Cartao';
        $this->controller = 'cartoes';
        $this->form = 'Financeiro\Form\CartaoForm';
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
