<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;
use Financeiro\Entity\Configurator;

class Cartegoria extends AbstractService{
    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->entity = 'Financeiro\Entity\FCartegoria';
        $this->nameId = 'idf_cartegoria';
    }
    
    public function inserir(array $data) {
        $entity = new $this->entity($data);                                                 //id do centro de custo na tabela cartegoria
        
        $centrocusto = $this->entityManager->getReference('Financeiro\Entity\FCentrocusto', $data['centrocusto']);
        $entity->setCentrocusto($centrocusto);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }
    public function update(array $data) {
       $reference = $this->entityManager->getReference($this->entity, $data['idf_cartegoria']);
       $entity = Configurator::configure($reference, $data);
       
       $centrocusto = $this->entityManager->getReference('Financeiro\Entity\FCentrocusto', $data['centrocusto']);
       $entity->setCentrocusto($centrocusto);
       $this->entityManager->persist($entity);
       $this->entityManager->flush();
       return $entity;
       
    }
}