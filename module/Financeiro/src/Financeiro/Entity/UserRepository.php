<?php

namespace Financeiro\Entity;

use Doctrine\ORM\EntityRepository;

class UserRepository extends EntityRepository{
    
public function findByEmailAndPassword($email, $password){
    $user = $this->findOneByEmail($email);
    
    if($user){
        if($user->getPassword() == $user->encryptedPassword($password)){
            return $user;
        }else{
            return false;
        }
    }else{
        return false;
    }
}
   
}
