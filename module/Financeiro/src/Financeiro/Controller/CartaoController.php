<?php

namespace Financeiro\Controller;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;

class CartaoController extends AbstractCrudController {

    public function __construct() {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro"));
        if ($auth->hasIdentity()) {
            $this->where = array('user' => $auth->getIdentity()->getId());
        } else {
            $this->where = array('user' => 0);
        }
        $this->entity = 'Financeiro\Entity\Cartao';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\Cartao';
        $this->controller = 'cartoes';
        $this->form = 'Financeiro\Form\CartaoForm';
    }
}
