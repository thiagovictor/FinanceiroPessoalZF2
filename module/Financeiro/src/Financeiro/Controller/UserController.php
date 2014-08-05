<?php

namespace Financeiro\Controller;

class UserController extends AbstractCrudController
{
    public function __construct() {
        $this->entity = 'Financeiro\Entity\User';
        $this->route = 'FinanceiroAdmin';
        $this->service = 'Financeiro\Services\User';
        $this->controller = 'user';
        $this->form = 'Financeiro\Form\UserForm';
    }
    public function getForm() {
        return $this->getServiceLocator()->get($this->form);
    }
}
