<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;
use Zend\Stdlib\Hydrator\ClassMethods;

class Lancamentos extends AbstractService {

    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->entity = 'Financeiro\Entity\Lancamentos';
        $this->nameId = 'id';
    }

    public function inserir(array $data) {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro"));

        $data['centrocusto'] = $this->entityManager->getReference('Financeiro\Entity\Centrocusto', $data['centrocusto']);
        $data['cartegoria'] = $this->entityManager->getReference('Financeiro\Entity\Cartegoria', $data['cartegoria']);
        $data['periodo'] = $this->entityManager->getReference('Financeiro\Entity\Periodo', $data['periodo']);
        $data['conta'] = $this->entityManager->getReference('Financeiro\Entity\Conta', $data['conta']);
        $data['favorecido'] = $this->entityManager->getReference('Financeiro\Entity\Favorecido', $data['favorecido']);
        $data['cartao'] = $this->entityManager->getReference('Financeiro\Entity\Cartao', $data['cartao']);
        $data['tipo'] = $this->entityManager->getReference('Financeiro\Entity\Tipo', $data['tipo']);
        $data['user'] = $this->entityManager->getReference('Financeiro\Entity\User', $auth->getIdentity()->getId());

        $entity = new $this->entity($data);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }

    public function update(array $data) {
        $reference = $this->entityManager->getReference($this->entity, $data['id']);
        $data['centrocusto'] = $this->entityManager->getReference('Financeiro\Entity\Centrocusto', $data['centrocusto']);
        $data['cartegoria'] = $this->entityManager->getReference('Financeiro\Entity\Cartegoria', $data['cartegoria']);
        $data['periodo'] = $this->entityManager->getReference('Financeiro\Entity\Periodo', $data['periodo']);
        $data['conta'] = $this->entityManager->getReference('Financeiro\Entity\Conta', $data['conta']);
        $data['favorecido'] = $this->entityManager->getReference('Financeiro\Entity\Favorecido', $data['favorecido']);
        $data['cartao'] = $this->entityManager->getReference('Financeiro\Entity\Cartao', $data['cartao']);
        $data['tipo'] = $this->entityManager->getReference('Financeiro\Entity\Tipo', $data['tipo']);
        
        $entity = (new ClassMethods())->hydrate($data, $reference);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }

}
