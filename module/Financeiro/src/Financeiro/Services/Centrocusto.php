<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;

class Centrocusto extends AbstractService{
    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->entity = 'Financeiro\Entity\Centrocusto';
        $this->nameId = 'id';
    }
    
    public function inserir(array $data) {
        $user = $this->entityManager->getReference('Financeiro\Entity\User', 1);//VALOR 1 SOMENTE PARA TESTES
        $data['user'] = $user;
        $entity = new $this->entity($data);                                                 
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }
}