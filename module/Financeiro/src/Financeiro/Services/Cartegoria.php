<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;
use Financeiro\Entity\Configurator;


class Cartegoria extends AbstractService{
    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->entity = 'Financeiro\Entity\Cartegoria';
        $this->nameId = 'id';
    }
    
    public function inserir(array $data) {
        $centrocusto = $this->entityManager->getReference('Financeiro\Entity\Centrocusto', $data['centrocusto']);
        $data['centrocusto'] = $centrocusto;
        $user = $this->entityManager->getReference('Financeiro\Entity\User', 1);//VALOR 1 SOMENTE PARA TESTES
        $data['user'] = $user;
        $entity = new $this->entity($data);                                                 
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }
    public function update(array $data) {
       $reference = $this->entityManager->getReference($this->entity, $data['id']);
       $centrocusto = $this->entityManager->getReference('Financeiro\Entity\Centrocusto', $data['centrocusto']);
       $data['centrocusto'] = $centrocusto;
       $entity = Configurator::configure($reference, $data);
       $this->entityManager->persist($entity);
       $this->entityManager->flush();
       return $entity;
       
    }
}