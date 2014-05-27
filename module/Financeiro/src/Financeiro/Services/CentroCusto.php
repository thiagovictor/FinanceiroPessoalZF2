<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;
use Financeiro\Entity\FCentrocusto;
use Financeiro\Entity\Configurator;

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
    public function update(array $data){
        $reference = $this->entityManager->getReference('Financeiro\Entity\FCentrocusto', $data['idf_centrocusto']);
        $entity = Configurator::configure($reference, $data);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }
}
