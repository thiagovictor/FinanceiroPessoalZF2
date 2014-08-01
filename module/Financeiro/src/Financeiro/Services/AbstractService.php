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
    protected $validarDonoEntidade = false;

    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }

    public function getContainer() {
        return new \Zend\Session\Container("Financeiro");
    }

    public function validarDono($id) {
        try {
            $entity = $this->entityManager->getReference($this->entity, $id);
            if ($this->validarDonoEntidade) {
                $sessao = $this->getContainer();
                if ($entity->getUser()->getId() == $sessao->user->getId()) {
                    return $entity;
                }
                return false; //retorna erro
            }
            return $entity;
      
        } catch (\Doctrine\ORM\EntityNotFoundException $ex) {
            return false; //retorna erro
        }
        
        
    }

    public function ajustar($array) {
        return $array;
    }

    public function inserir(array $data) {
        $entity = new $this->entity($data);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }

    public function update(array $data) {
        $reference = $this->entityManager->getReference($this->entity, $data[$this->nameId]);
        $entity = (new ClassMethods)->hydrate($data, $reference);
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        return $entity;
    }

    public function delete($id) {
        $entity = $this->validarDono($id);
        if ($entity) {
            $this->entityManager->remove($entity);
            $this->entityManager->flush();
            return $id;
        }
        //retorna erro.
    }

}
