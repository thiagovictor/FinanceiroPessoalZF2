<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;

class Conta extends AbstractService {

    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->entity = 'Financeiro\Entity\Conta';
        $this->nameId = 'id';
        $this->validarDonoEntidade = true;
    }

    public function inserir(array $data) {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro"));
        $user = $this->entityManager->getReference('Financeiro\Entity\User', $auth->getIdentity()->getId());
        $data['user'] = $user;
        $data['saldo'] = str_replace(',', '.', str_replace('.', '', $data['saldo']));
        $entity = new $this->entity($data);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }

    public function update(array $data) {
        $reference = $this->entityManager->getReference($this->entity, $data[$this->nameId]);
        $data['saldo'] = str_replace(',', '.', str_replace('.', '', $data['saldo']));
        $entity = (new ClassMethods)->hydrate($data, $reference);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }

    public function ajustar($array) {
        $array["saldo"] = number_format($array["saldo"], 2, ',', '.');
        return $array;
    }

}
