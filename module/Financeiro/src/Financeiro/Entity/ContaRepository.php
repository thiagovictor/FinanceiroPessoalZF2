<?php

namespace Financeiro\Entity;

use Doctrine\ORM\EntityRepository;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;

class ContaRepository extends EntityRepository{
    public function fatchPairs() {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro"));
        $contas = $this->findBy(array('user'=>$auth->getIdentity()->getId()),array());
        $array = array();
        foreach ($contas as $conta ){
            $array[$conta->getId()] = $conta->getDescricao();
        }
        return $array;
    }
}