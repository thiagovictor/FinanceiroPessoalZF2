<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;

class Periodo extends AbstractService{
    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->entity = 'Financeiro\Entity\Periodo';
        $this->nameId = 'id';
    }
}