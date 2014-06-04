<?php

namespace Financeiro\Controller;

class ControladorController extends AbstractCrudController
{
    public function __construct() {
        $this->entity = 'Financeiro\Entity\Controlador';
        $this->route = 'FinanceiroAdmin';
        $this->service = 'Financeiro\Services\Controlador';
        $this->controller = 'modulos';
        $this->form = 'Financeiro\Form\ControladorForm';
    }
}
