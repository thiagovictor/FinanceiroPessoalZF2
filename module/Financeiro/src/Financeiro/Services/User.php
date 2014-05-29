<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;
use Financeiro\Entity\Configurator;


class User extends AbstractService{
    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->entity = 'Financeiro\Entity\User';
        $this->nameId = 'id';
    }
    
    public function inserir(array $data) {
        $ativo = $this->entityManager->getReference('Financeiro\Entity\Ativo', $data['ativo']);
        $data['ativo'] = $ativo;
        //Valor do id do ativo deve ser substituido pela entidade antes de popular
        $entity = new $this->entity($data);                                                 
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }
    public function update(array $data) {
       $reference = $this->entityManager->getReference($this->entity, $data['id']);
       $ativo = $this->entityManager->getReference('Financeiro\Entity\Ativo', $data['ativo']);
       $data['ativo'] = $ativo;
       $entity = Configurator::configure($reference, $data);
       //Valor do id do ativo deve ser substituido pela entidade antes de popular
       $this->entityManager->persist($entity);
       $this->entityManager->flush();
       return $entity;
       
    }
}