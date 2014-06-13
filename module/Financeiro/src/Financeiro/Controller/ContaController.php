<?php

namespace Financeiro\Controller;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;

class ContaController extends AbstractCrudController {

    public function __construct() {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro"));
        if ($auth->hasIdentity()) {
            $this->where = array('user' => $auth->getIdentity()->getId());
        } else {
            $this->where = array('user' => 0);
        }
        $this->entity = 'Financeiro\Entity\Conta';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\Conta';
        $this->controller = 'contas';
        $this->form = 'Financeiro\Form\ContaForm';
    }
}
