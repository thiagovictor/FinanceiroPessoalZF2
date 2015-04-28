<?php

namespace Financeiro\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository {
    public function fatchPairs() {
        $entities = $this->findAll();
        $array = array();
        foreach ($entities as $entity) {
            $array[$entity->getId()] = $entity->getUsername();
        }
        return $array;
    }
    public function findByEmailAndPassword($email, $password) {
        $user = $this->findOneByEmail($email);

        if ($user) {
            if ($user->getPassword() == $user->encryptedPassword($password)) {
                return $user;
            } else {
                return false;
            }
        } else {
            return false;
        }
    }
    
    public function findById($id) {
        $user = $this->findOneById($id);
        if ($user) {
            return $user;
        }
        return false;
    }
    

}
