<?php


namespace Financeiro\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Financeiro\Form\AuthForm;
use Zend\Authentication\AuthenticationService;
use Zend\Authentication\Storage\Session;
class AuthController extends AbstractActionController {
   
    public function indexAction(){
        $form = new AuthForm();
        $error = false;
        
        $request = $this->getRequest();
        if($request->isPost()){
            
            $form->setData($request->getPost());
            if($form->isValid()){
                $data = $form->getData();
                $auth = new AuthenticationService();
                $sessionStorage = new Session('Financeiro');
                $auth->setStorage($sessionStorage);
                $authAdapter = $this->getServiceLocator()->get('Financeiro\Auth\Adapter');
                $authAdapter->setUsername($data['email'])
                       ->setPassword($data['password']);
                $result = $auth->authenticate($authAdapter);
                if($result->isValid()){
                    $sessionStorage->write($auth->getIdentity()['user'], null);
                    return $this->redirect()->toRoute('Financeiro' , array('controller'=>'user'));
                }else{
                    $error = true;
                }
            }
        }
        
        return new ViewModel(array('form'=> $form, 'error'=>$error));
    }
    public function logoutAction() {
        $auth = new AuthenticationService;
        $auth->setStorage(new Session('Financeiro'));
        $auth->clearIdentity();
        
        return $this->redirect()->toRoute('FinanceiroAdmin',array('controller'=>'auth'));
    }
}
