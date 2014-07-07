<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator\ClassMethods;


class Acoes extends AbstractService{
    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->entity = 'Financeiro\Entity\Acoes';
        $this->nameId = 'id';
    }
    
    public function inserir(array $data) {
        $controlador = $this->entityManager->getReference('Financeiro\Entity\Controlador', $data['controlador']);
        $data['controlador'] = $controlador;
        $entity = new $this->entity($data); 
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }
    public function update(array $data) {
       $reference = $this->entityManager->getReference($this->entity, $data['id']);
       $controlador = $this->entityManager->getReference('Financeiro\Entity\Controlador', $data['controlador']);
       $data['controlador'] = $controlador;
       
       $entity = (new ClassMethods)->hydrate($data, $reference);
       $this->entityManager->persist($entity);
       $this->entityManager->flush();
       return $entity;
       
    }
}