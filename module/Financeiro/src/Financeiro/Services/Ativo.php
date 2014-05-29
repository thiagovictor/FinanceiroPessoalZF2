<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;

class Ativo extends AbstractService{
    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->entity = 'Financeiro\Entity\Ativo';
        $this->nameId = 'id';
    }
}