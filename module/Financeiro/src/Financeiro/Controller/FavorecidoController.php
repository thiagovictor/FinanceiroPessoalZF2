<?php

namespace Financeiro\Controller;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;

class FavorecidoController extends AbstractCrudController {

    public function __construct() {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro"));
        if ($auth->hasIdentity()) {
            $this->where = array('user' => $auth->getIdentity()->getId());
        } else {
            $this->where = array('user' => 0);
        }
        $this->entity = 'Financeiro\Entity\Favorecido';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\Favorecido';
        $this->controller = 'favorecido';
        $this->form = 'Financeiro\Form\FavorecidoForm';
    }
}
