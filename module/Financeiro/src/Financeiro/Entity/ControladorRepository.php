<?php

namespace Financeiro\Entity;

use Doctrine\ORM\EntityRepository;

class ControladorRepository extends EntityRepository{
    public function fatchPairs() {
        $entities = $this->findAll();
        $array = array();
        foreach ($entities as $entity ){
            $array[$entity->getId()] = $entity->getNome();
        }
        return $array;
    }
    public function fatchCombo() {
        $entities = $this->findAll();
        $array = array();
        $array[0] ='Selecione o módulo';
        foreach ($entities as $entity ){
            $array[$entity->getId()] = $entity->getNome();
        }
        return $array;
    }
}
