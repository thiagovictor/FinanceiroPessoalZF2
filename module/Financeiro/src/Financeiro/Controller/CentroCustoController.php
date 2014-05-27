<?php

namespace Financeiro\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Financeiro\Form\CentroCustoForm;

class CentroCustoController extends AbstractActionController
{
    /**
     * 
     * @var EntityManager
     */
    protected  $entityManager;
    
    public function indexAction()
    {
        
        $repo = $this->getEM()->getRepository('Financeiro\Entity\FCentrocusto');
        $listaCentroCusto = $repo->findAll();
        
        $count = 15;
        $page = $this->params()->fromRoute('page');
        $paginator = new Paginator(new ArrayAdapter($listaCentroCusto));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage($count);
        return new ViewModel(array('centrosdecusto' => $paginator, 'page'=>$page));
    }
    
    public function newAction()
    {   
        $form = new CentroCustoForm('CentroCusto');
        $request = $this->getRequest();
        if($request->isPost()){
            $form->setData($request->getPost());
            if($form->isValid()){
               $service = $this->getServiceLocator()->get('Financeiro\Services\CentroCusto');
               $service->inserir($request->getPost()->toArray());
               return $this->redirect()->toRoute('Financeiro', array('controller'=>'centrocusto'));
            }
        }
        
        return new ViewModel(array('form'=> $form));
    }

    public function getEM()
    {
        if (null === $this->entityManager){
            $this->entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->entityManager;
    }
}
