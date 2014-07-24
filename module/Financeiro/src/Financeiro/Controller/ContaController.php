<?php

namespace Financeiro\Controller;

use Zend\View\Model\ViewModel;
use Zend\Stdlib\Hydrator\ClassMethods;

class ContaController extends AbstractCrudController {

    public function __construct() {
        $this->entity = 'Financeiro\Entity\Conta';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\Conta';
        $this->controller = 'contas';
        $this->form = 'Financeiro\Form\ContaForm';
    }

    public function getLista() {
        $repo = $this->getEM()->getRepository($this->entity);
        if ($this->getAuthentication()->hasIdentity()) {
            return $repo->findBy(array(
                        'user' => $this->getAuthentication()->getIdentity()->getId()
            ));
        } else {
            return array();
        }
    }

}
