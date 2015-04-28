<?php

namespace Financeiro\Entity;

use Doctrine\ORM\EntityRepository;

class ResumoRepository extends EntityRepository{
    public function resumoMes() {
        $container = new \Zend\Session\Container("Financeiro");
        $query = $this->createQueryBuilder('p')
                ->where('p.competencia = :competencia and p.user = :user')
                ->setParameters(array(
                    'competencia'=>$container->baseDate."-01",
                    'user' => $container->user->getId()
                ))
                ->getQuery();
        return $query->getResult();
    }

}
