<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;

class Tipo extends AbstractService{
    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->entity = 'Financeiro\Entity\Tipo';
        $this->nameId = 'id';
    }
}