<?php

namespace Financeiro\Controller;



class CentroCustoController extends AbstractCrudController
{
    public function __construct() {
        $this->entity = 'Financeiro\Entity\FCentrocusto';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\CentroCusto';
        $this->controller = 'centrocusto';
        $this->form = 'Financeiro\Form\CentroCustoForm';
    }
}
