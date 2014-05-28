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
        $centrocusto = $this->entityManager->getReference('Financeiro\Entity\FCentrocusto', $data['centrocusto']);
        $data['centrocusto'] = $centrocusto;
        //Valor do id do centro de custo deve ser substituido pela entidade antes de popular
        $entity = new $this->entity($data);                                                 
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }
    public function update(array $data) {
       $reference = $this->entityManager->getReference($this->entity, $data['idf_cartegoria']);
       $centrocusto = $this->entityManager->getReference('Financeiro\Entity\FCentrocusto', $data['centrocusto']);
       $data['centrocusto'] = $centrocusto;
       $entity = Configurator::configure($reference, $data);
       //Valor do id do centro de custo deve ser substituido pela entidade antes de popular
       $this->entityManager->persist($entity);
       $this->entityManager->flush();
       return $entity;
       
    }
}