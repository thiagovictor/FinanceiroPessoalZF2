<?php

namespace Financeiro\Services;

use Doctrine\ORM\EntityManager;
use Financeiro\Entity\Configurator;

class Permissao extends AbstractService {

    public function __construct(EntityManager $entityManager) {
        parent::__construct($entityManager);
        $this->entity = 'Financeiro\Entity\Permissao';
        $this->nameId = 'id';
    }

    public function inserir(array $data) {
        $user = $this->entityManager->getReference('Financeiro\Entity\User', $data['user']);
        $data['user'] = $user;
        $controlador = $this->entityManager->getReference('Financeiro\Entity\Controlador', $data['controlador']);
        $data['controlador'] = $controlador;
        $acoes = $this->entityManager->getReference('Financeiro\Entity\Acoes', $data['acoes']);
        $data['acoes'] = $acoes;
        $entity = new $this->entity($data);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }

    public function update(array $data) {
        $reference = $this->entityManager->getReference($this->entity, $data['id']);

        $user = $this->entityManager->getReference('Financeiro\Entity\User', $data['user']);
        $data['user'] = $user;
        $controlador = $this->entityManager->getReference('Financeiro\Entity\Controlador', $data['controlador']);
        $data['controlador'] = $controlador;
        $acoes = $this->entityManager->getReference('Financeiro\Entity\Acoes', $data['acoes']);
        $data['acoes'] = $acoes;

        $entity = Configurator::configure($reference, $data);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }

}
