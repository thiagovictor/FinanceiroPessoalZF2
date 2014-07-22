<?php

namespace Financeiro\Controller;

use Zend\View\Model\ViewModel;
use Zend\Authentication\AuthenticationService,
    Zend\Authentication\Storage\Session;
use Zend\Stdlib\Hydrator\ClassMethods;
use Zend\Paginator\Paginator,
 Zend\Paginator\Adapter\ArrayAdapter;

class LancamentosController extends AbstractCrudController {

    public function __construct() {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session("Financeiro"));
        if ($auth->hasIdentity()) {
            $this->where = array('user' => $auth->getIdentity()->getId());
        } else {
            $this->where = array('user' => 0);
        }
        $this->entity = 'Financeiro\Entity\Lancamentos';
        $this->route = 'Financeiro';
        $this->service = 'Financeiro\Services\Lancamentos';
        $this->controller = 'lancamentos';
        $this->form = 'Financeiro\Form\LancamentosForm';
    }
    
    public function indexAction()
    {
        $container = new \Zend\Session\Container("Financeiro");
        $repo = $this->getEM()->getRepository($this->entity);
        $query = $repo->createQueryBuilder('p')
                ->where('(p.vencimento >= :dateBaseIni and p.vencimento <= :dateBaseFim) or (p.vencimento < :dateBaseIni and p.pagamento is null) or (p.pagamento >= :dateBaseIni and p.pagamento <= :dateBaseFim) and p.user = :user')
                ->setParameters(array(
                    'dateBaseIni'=>$container->baseDate."-01",
                    'dateBaseFim'=>$container->baseDate."-31",
                    'user' => $container->user->getId()
                ))
                ->orderBy('p.vencimento', 'ASC')
                ->getQuery();

//        print_r($query->getSQL());
//        print_r($container->baseDate."-01");
        $lista = $query->getResult();
        $count = 12;
        $page = $this->params()->fromRoute('page');
        $paginator = new Paginator(new ArrayAdapter($lista));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage($count);
        return new ViewModel(array('lista' => $paginator, 'page'=>$page));
    }
    
    public function newAction() {
        $form = $this->getServiceLocator()->get($this->form);
        $request = $this->getRequest();
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service = $this->getServiceLocator()->get($this->service);
                $service->inserir($form->getData());
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        return new ViewModel(array('form' => $form));
    }

    public function editAction() {
        $service = $this->getServiceLocator()->get($this->service);
        $form = $this->getServiceLocator()->get($this->form);
        $request = $this->getRequest();
        $repository = $this->getEM()->getRepository($this->entity);
        $entity = $repository->find($this->params()->fromRoute('id', 0));
        if ($this->params()->fromRoute('id', 0)) {
            $array = (new ClassMethods())->extract($entity);
            $arrayPronto = $service->ajustar($array);
            $form->setData($arrayPronto);
        }
        if ($request->isPost()) {
            $form->setData($request->getPost());
            if ($form->isValid()) {
                $service->update($form->getData());
                return $this->redirect()->toRoute($this->route, array('controller' => $this->controller));
            }
        }
        return new ViewModel(array('form' => $form));
    }

}
