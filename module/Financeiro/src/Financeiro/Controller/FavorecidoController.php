<?php

namespace Financeiro\Controller;

class FavorecidoController extends AbstractCrudController {

    public function __construct() {
        $this->entity = 'Financeiro\Entity\Favorecido';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\Favorecido';
        $this->controller = 'favorecido';
        $this->form = 'Financeiro\Form\FavorecidoForm';
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
