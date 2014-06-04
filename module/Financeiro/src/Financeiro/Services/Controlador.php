<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;

class Controlador extends AbstractService{
    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->entity = 'Financeiro\Entity\Controlador';
        $this->nameId = 'id';
    }
}