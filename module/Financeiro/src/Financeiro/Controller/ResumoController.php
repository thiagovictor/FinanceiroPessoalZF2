<?php



namespace Financeiro\Controller ;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;


class ResumoController extends AbstractActionController{
    private $entityManager;
    private $entity = "Financeiro\Entity\Resumo";
    
    public function getEM() {
        if (null === $this->entityManager) {
            $this->entityManager = $this->getServiceLocator()->get('Doctrine\ORM\EntityManager');
        }
        return $this->entityManager;
    }
    public function getLista() {
        $repo = $this->getEM()->getRepository($this->entity);
        return $repo->resumoMes();
    }
    public function indexAction() {
        $auth = new \Zend\Authentication\AuthenticationService();
        $auth->setStorage(new \Zend\Authentication\Storage\Session("Financeiro"));
        
            $user_reference = $this->getEM()->getReference('Financeiro\Entity\User', $auth->getIdentity()->getId());
         $container = new \Zend\Session\Container("Financeiro");
         //\Zend\Debug\Debug::dump($user_reference);
        $service = $this->getServiceLocator()->get('Financeiro\Services\Resumo');
        $repo = $this->getEM()->getRepository("\Financeiro\Entity\User");
        $user_com_erro = $auth->getIdentity();
        $user_sem_erro = $repo->findById($auth->getIdentity());
        
        $data = array
            (
                "user"=>$user_reference,
                "competencia"=>new \DateTime("2015-04-01"),
                "despesa"=>"1500",
                "receita"=>"1500"
            );
        $service->inserir($data);
        $lista = $this->getLista();
        $count = 12;
        $page = $this->params()->fromRoute('page');
        $paginator = new Paginator(new ArrayAdapter($lista));
        $paginator->setCurrentPageNumber($page);
        $paginator->setDefaultItemCountPerPage($count);
        return new ViewModel(array('lista' => $paginator, 'page' => $page));
        
    }
}
