<?php

namespace Financeiro\Controller;

class TipoController extends AbstractCrudController {

    public function __construct() {
        $this->entity = 'Financeiro\Entity\Tipo';
        $this->route = 'FinanceiroAdmin';
        $this->service = 'Financeiro\Services\Tipo';
        $this->controller = 'tipos';
        $this->form = 'Financeiro\Form\TipoForm';
    }

}
