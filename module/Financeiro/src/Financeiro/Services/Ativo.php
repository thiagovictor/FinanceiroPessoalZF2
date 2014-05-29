<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;

class CentroCusto extends AbstractService{
    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->entity = 'Financeiro\Entity\FCentrocusto';
        $this->nameId = 'idf_centrocusto';
    }
}