<?php

namespace Financeiro\Controller;



class AtivoController extends AbstractCrudController
{
    public function __construct() {
        $this->entity = 'Financeiro\Entity\Ativo';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\Ativo';
        $this->controller = 'ativo';
        $this->form = 'Financeiro\Form\AtivoForm';
    }
}
