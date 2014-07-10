<?php

namespace Financeiro\Entity;

use Doctrine\ORM\EntityRepository;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;

class CartaoRepository extends EntityRepository{
    public function fatchPairs() {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro"));
        $cartoes = $this->findBy(array('user'=>$auth->getIdentity()->getId()),array());
        $array = array();
        foreach ($cartoes as $cartao ){
            $array[$cartao->getId()] = $cartao->getDescricao();
        }
        return $array;
    }
    public function selecao() {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro"));
        $cartoes = $this->findBy(array('user'=>$auth->getIdentity()->getId()),array());
        $array = array();
        $array["0"] = "Selecione o cartão"; 
        foreach ($cartoes as $cartao ){
            $array[$cartao->getId()] = $cartao->getDescricao();
        }
        return $array;
    }
}
