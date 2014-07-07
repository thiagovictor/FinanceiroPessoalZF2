<?php
namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator\ClassMethods;

abstract class AbstractService {
    /**
    * @var EntityManager
    */
    protected $entityManager;
    protected $entity;
    protected $nameId;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function inserir(array $data){       
        $entity = new $this->entity($data); 
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }
    public function update(array $data){
        $reference = $this->entityManager->getReference($this->entity, $data[$this->nameId]);
        $entity = (new ClassMethods)->hydrate($data, $reference);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }
    public function delete($id){
       $entity = $this->entityManager->getReference($this->entity, $id);
       if ($entity){
           $this->entityManager->remove($entity);
           $this->entityManager->flush();
           return $id;
       }
    }
}
