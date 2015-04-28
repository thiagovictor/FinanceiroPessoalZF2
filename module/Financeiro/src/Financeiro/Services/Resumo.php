<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator\ClassMethods;


class Resumo extends AbstractService{
    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->entity = 'Financeiro\Entity\Resumo';
        $this->nameId = 'id';
    }
    
    public function inserir(array $data) {
        $entity = new $this->entity($data); 
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }
    public function update(array $data) {
       $reference = $this->entityManager->getReference($this->entity, $data['id']);     
       $entity = (new ClassMethods)->hydrate($data, $reference);
       $this->entityManager->persist($entity);
       $this->entityManager->flush();
       return $entity;
       
    }
}