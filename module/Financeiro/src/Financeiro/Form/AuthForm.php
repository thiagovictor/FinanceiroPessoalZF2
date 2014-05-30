<?php


namespace Financeiro\Form;

use Zend\Form\Form;


class AuthForm extends Form{
    
   
    
    public function __construct($name = null) {
        parent::__construct($name);
        $this->params();
    }
    public function params(){
        $this->setAttribute('method', 'post');
        $this->setName('Login');

        $this->add(array(
           'name' => 'email',
            'options' => array(
                'type' => 'email',
            ),
            'attributes' => array(
                'id' => 'email',
                'placeholder' => 'Entre com o email'
            )
        ));
        $this->add(array(
           'name' => 'password',
            'options' => array(
                'type' => 'password',
            ),
            'attributes' => array(
                'id' => 'password',
                'type' => 'password',
                'placeholder' => 'Entre com o password'
            )
        ));
        
       
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
