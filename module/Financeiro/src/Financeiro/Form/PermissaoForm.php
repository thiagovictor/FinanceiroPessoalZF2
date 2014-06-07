<?php

namespace Financeiro\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

class PermissaoForm extends Form{
    
    protected $arrayusers;
    protected $arraycontrollers;
    protected $arrayacoes;
    
    public function __construct(array $arrayusers = null, array $arraycontrollers = null, array $arrayacoes = null, $name = null) {
        parent::__construct($name);
        $this->arrayusers = $arrayusers;
        $this->arraycontrollers = $arraycontrollers;
        $this->arrayacoes = $arrayacoes;
        $this->params();
    }
    public function params(){
        $this->setAttribute('method', 'post');
        $this->setName('permissao');
        
        $this->add(array(
           'name' =>'id',
            'options' => array(
                'type' => 'hidden',
            ),
           
        ));
                
        $users = new Select();
        $users->setName('user')
                       ->setOptions(array('value_options'=>$this->arrayusers));
        $this->add($users);
        
        $controllers = new Select();
        $controllers->setName('controlador')
                       ->setOptions(array('value_options'=>$this->arraycontrollers));
        $this->add($controllers);
        
        $acoes = new Select();
        $acoes->setName('acoes')
                       ->setOptions(array('value_options'=>$this->arrayacoes));
        $this->add($acoes);
        
        
        $this->add(array(
           'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn btn-success'
            )
        ));
    }
}
