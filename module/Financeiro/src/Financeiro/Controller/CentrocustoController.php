<?php

namespace Financeiro\Controller;



class CentrocustoController extends AbstractCrudController
{
    public function __construct() {
        $this->entity = 'Financeiro\Entity\Centrocusto';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\Centrocusto';
        $this->controller = 'centrocusto';
        $this->form = 'Financeiro\Form\CentrocustoForm';
    }
}
