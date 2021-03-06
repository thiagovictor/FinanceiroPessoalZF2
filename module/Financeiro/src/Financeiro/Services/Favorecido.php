<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;

class Favorecido extends AbstractService{
    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->entity = 'Financeiro\Entity\Favorecido';
        $this->nameId = 'id';
        $this->validarDonoEntidade = true;
    }
    
    public function inserir(array $data) {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro")); 
        $user = $this->entityManager->getReference('Financeiro\Entity\User', $auth->getIdentity()->getId());
        $data['user'] = $user;
        $entity = new $this->entity($data);                                                 
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }
}