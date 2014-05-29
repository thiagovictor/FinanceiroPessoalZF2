<?php


namespace Financeiro\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

class UserForm extends Form{
    
    protected $arrayativo;
    
    public function __construct(array $arrayativo = null, $name = null) {
        parent::__construct($name);
        $this->arrayativo = $arrayativo;
        $this->params();
    }
    public function params(){
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new CartegoriaFilter);
        $this->setName('user');
        
        $this->add(array(
           'name' =>'id',
            'options' => array(
                'type' => 'hidden',
            ),
           
        ));
                
        $this->add(array(
           'name' => 'username',
            'options' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'id' => 'username',
                'placeholder' => 'Entre com o nome'
            )
        ));
        
         $this->add(array(
           'name' => 'email',
            'options' => array(
                'type' => 'text',
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
                'placeholder' => 'Entre com o a senha'
            )
        ));
        
        $this->add(array(
           'name' => 'salt',
            'options' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'id' => 'salt',
                'placeholder' => 'Entre com o salt'
            )
        ));
        
        $this->add(array(
           'name' => 'telefone',
            'options' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'id' => 'telefone',
                'placeholder' => 'Entre com o telefone'
            )
        ));
         
        $this->add(array(
           'name' => 'celular',
            'options' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'id' => 'celular',
                'placeholder' => 'Entre com o celular'
            )
        ));
        
                
        $ativos = new Select();
        $ativos->setName('ativo')
                       ->setOptions(array('value_options'=>$this->arrayativo));
        $this->add($ativos);
        
        
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
