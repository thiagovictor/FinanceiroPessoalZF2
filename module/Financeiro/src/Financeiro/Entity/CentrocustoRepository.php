<?php

namespace Financeiro\Entity;

use Doctrine\ORM\EntityRepository;

class CentrocustoRepository extends EntityRepository{
    public function fatchPairs() {
        $entities = $this->findAll();
        $array = array();
        foreach ($entities as $entity ){
            $array[$entity->getId()] = $entity->getDescricao();
        }
        return $array;
    }
}
