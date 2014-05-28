<?php

namespace Financeiro\Entity;

use Doctrine\ORM\EntityRepository;
class CentroCustoRepository extends EntityRepository{
    public function fatchPairs() {
        $entities = $this->findAll();
        $array = array();
        foreach ($entities as $entity ){
            $array[$entity->getIdfCentrocusto()] = $entity->getDescricao();
        }
        return $array;
    }
}
