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
        $entity = new $this->entity($data); 
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }
    public function update(array $data) {
       $reference = $this->entityManager->getReference($this->entity, $data['id']);
       $ativo = $this->entityManager->getReference('Financeiro\Entity\Ativo', $data['ativo']);
       $data['ativo'] = $ativo;
       if(empty($data['password'])){
           unset ($data['password']);
       }
       $entity = Configurator::configure($reference, $data);
       $this->entityManager->persist($entity);
       $this->entityManager->flush();
       return $entity;
       
    }
}