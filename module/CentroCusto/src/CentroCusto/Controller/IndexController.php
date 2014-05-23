<?php

namespace CentroCusto\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;

class IndexController extends AbstractActionController
{
    /**
     * 
     * @var EntityManager
     */
    protected  $entityManager;
    
    public function indexAction()
    {
        
        $repo = $this->getEM()->getRepository('CentroCusto\Entity\FCentrocusto');
        $listaCentroCusto = $repo->findAll();
        
        $count = 10;
        $page = $this->params()->fromRoute('page');
        $paginator = new Paginator(new ArrayAdapter($listaCentroCusto));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage($count);
        return new ViewModel(array('centrosdecusto' => $paginator, 'page'=>$page));
    }
    public function getEM()
    {
        if (null === $this->entityManager){
            $this->entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->entityManager;
    }
}
