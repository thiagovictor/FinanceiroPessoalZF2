<?php

namespace Financeiro\Controller;

class PermissaoController extends AbstractCrudController
{
    public function __construct() {
        $this->entity = 'Financeiro\Entity\Permissao';
        $this->route = 'FinanceiroAdmin';
        $this->service = 'Financeiro\Services\Permissao';
        $this->controller = 'permissoes';
        $this->form = 'Financeiro\Form\PermissaoForm';
    }
    
    public function getForm() {
        return $this->getServiceLocator()->get($this->form);
    }
}
