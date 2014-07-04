<?php

namespace Financeiro\Entity;

use Doctrine\ORM\EntityRepository;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;

class CartegoriaRepository extends EntityRepository{
   public function fatchPairs() {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro"));
        $cartegorias = $this->findBy(array('user'=>$auth->getIdentity()->getId()),array());
        $array = array();
        foreach ($cartegorias as $cartegoria ){
            $array[$cartegoria->getId()] = $cartegoria->getDescricao();
        }
        return $array;
    }
}
