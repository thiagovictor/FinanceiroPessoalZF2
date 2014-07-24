<?php

namespace Financeiro\Controller;

class PeriodoController extends AbstractCrudController {

    public function __construct() {
        $this->entity = 'Financeiro\Entity\Periodo';
        $this->route = 'FinanceiroAdmin';
        $this->service = 'Financeiro\Services\Periodo';
        $this->controller = 'periodos';
        $this->form = 'Financeiro\Form\PeriodoForm';
    }

}
