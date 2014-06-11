<?php

namespace Financeiro\Entity;

use Doctrine\ORM\EntityRepository;

class AcoesRepository extends EntityRepository {

    public function fatchPairs() {
        $entities = $this->findAll();
        $array = array();
        foreach ($entities as $entity) {
            $array[$entity->getId()] = $entity->getNome();
        }
        return $array;
    }
}
