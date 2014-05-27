<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;
use Financeiro\Entity\FCentrocusto;
class CentroCusto {
    /**
    * @var EntityManager
    */
    protected $entityManager;


    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function inserir(array $data){       
        $entity = new FCentrocusto($data); 
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }
}
