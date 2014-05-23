<?php

namespace CentroCusto\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;

class IndexController extends AbstractActionController
{
    public function indexAction()
    {
        $entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        $repo = $entityManager->getRepository('CentroCusto\Entity\FCentrocusto');
        $centroDeCusto = $repo->findAll();
        return new ViewModel(array('centrosdecusto' => $centroDeCusto));
    }
}
