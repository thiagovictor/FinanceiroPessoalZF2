<?php

namespace Financeiro\Entity;

use Doctrine\ORM\EntityRepository;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;

class FavorecidoRepository extends EntityRepository{
    public function fatchPairs() {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro"));
        $favorecidos = $this->findBy(array('user'=>$auth->getIdentity()->getId()),array());
        $array = array();
        foreach ($favorecidos as $favorecido ){
            $array[$favorecido->getId()] = $favorecido->getDescricao();
        }
        return $array;
    }
}
