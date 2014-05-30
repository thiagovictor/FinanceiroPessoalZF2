<?php

namespace Financeiro\Auth;

use Zend\Authentication\Adapter\AdapterInterface,   
    Zend\Authentication\Result;
use Doctrine\ORM\EntityManager;

class Adapter implements AdapterInterface {
    /**
     * @var EntityManager
     */
    protected $entityManager;
    protected $username;
    protected $password;
    
    public function __construct(EntityManager $entityManager) {
        $this->entityManager = $entityManager;
    }
    public function getUsername() {
        return $this->username;
    }

    public function getPassword() {
        return $this->password;
    }

    public function setUsername($username) {
        $this->username = $username;
        return $this;
    }

    public function setPassword($password) {
        $this->password = $password;
        return $this;
    }
    
    public function authenticate() {
        $repository = $this->entityManager->getRepository('Financeiro\Entity\User');
        $user = $repository->findByEmailAndPassword($this->getUsername(), $this->getPassword());
        if($user){
            return new Result(Result::SUCCESS, array('user'=>$user),array('ok'));
        }else{
            return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, array());
        }
    } 
}
