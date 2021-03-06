<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;
use Zend\Stdlib\Hydrator\ClassMethods;


class Cartegoria extends AbstractService{
    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->entity = 'Financeiro\Entity\Cartegoria';
        $this->nameId = 'id';
        $this->validarDonoEntidade = true;
    }
    
    public function inserir(array $data) {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro")); 
        $centrocusto = $this->entityManager->getReference('Financeiro\Entity\Centrocusto', $data['centrocusto']);
        $data['centrocusto'] = $centrocusto;
        $user = $this->entityManager->getReference('Financeiro\Entity\User', $auth->getIdentity()->getId());
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
       $entity = (new ClassMethods())->hydrate($data, $reference);
       $this->entityManager->persist($entity);
       $this->entityManager->flush();
       return $entity;
       
    }
}