<?php

namespace Financeiro\Entity;

use Doctrine\ORM\EntityRepository;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;

class CentrocustoRepository extends EntityRepository{
    public function fatchPairs() {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro"));
        $entities = $this->findBy(array('user'=>$auth->getIdentity()->getId()),array());
        $array = array();
        foreach ($entities as $entity ){
            $array[$entity->getId()] = $entity->getDescricao();
        }
        return $array;
    }
     public function selecao() {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro"));
        $entities = $this->findBy(array('user'=>$auth->getIdentity()->getId()),array());
        $array = array();
        $array[""] = "Selecione um item";
        foreach ($entities as $entity ){
            $array[$entity->getId()] = $entity->getDescricao();
        }
        return $array;
    }
}
