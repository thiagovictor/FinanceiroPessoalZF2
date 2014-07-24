<?php

namespace Financeiro\Entity;

use Doctrine\ORM\EntityRepository;
class LancamentosRepository extends EntityRepository{
    public function lancamentosGeralMes() {
        $container = new \Zend\Session\Container("Financeiro");
        $query = $this->createQueryBuilder('p')
                ->where('((p.vencimento >= :dateBaseIni and p.vencimento <= :dateBaseFim) or (p.vencimento < :dateBaseIni and p.pagamento is null) or (p.pagamento >= :dateBaseIni and p.pagamento <= :dateBaseFim)) and p.user = :user')
                ->setParameters(array(
                    'dateBaseIni'=>$container->baseDate."-01",
                    'dateBaseFim'=>$container->baseDate."-31",
                    'user' => $container->user->getId()
                ))
                ->orderBy('p.pagamento,p.vencimento', 'ASC')
                ->getQuery();
        //\Zend\Debug\Debug::dump($query->getSQL());
        //\Zend\Debug\Debug::dump($container->user->getId());
        return $query->getResult();
    }
}
