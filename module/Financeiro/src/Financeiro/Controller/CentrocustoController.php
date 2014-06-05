<?php

namespace Financeiro\Controller;

use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;


class CentrocustoController extends AbstractCrudController
{
    public function __construct() {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro")); 
        $this->entity = 'Financeiro\Entity\Centrocusto';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\Centrocusto';
        $this->controller = 'centrocusto';
        $this->form = 'Financeiro\Form\CentrocustoForm';
        $this->where = array('user'=>$auth->getIdentity()->getId());
    }
}
