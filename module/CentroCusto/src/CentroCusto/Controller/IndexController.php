<?php

namespace CentroCusto\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use CentroCusto\Form\CentroCustoForm;

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
        
        $count = 30;
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
               $service = $this->getServiceLocator()->get('CentroCusto\Services\CentroCusto');
               $service->inserir($request->getPost()->toArray());
               return $this->redirect()->toRoute('CentroCusto', array('controller'=>'centrocusto'));
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
