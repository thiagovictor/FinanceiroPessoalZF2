<?php


namespace Financeiro\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

class AcoesForm extends Form{
    
    protected $arraycontrollers;
    
    public function __construct(array $arraycontrollers = null, $name = null) {
        parent::__construct($name);
        $this->arraycontrollers = $arraycontrollers;
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
           'name' => 'nome',
            'options' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'id' => 'nome',
                'placeholder' => 'Entre com o nome'
            )
        ));
        
         $this->add(array(
           'name' => 'descricao',
            'options' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'id' => 'descricao',
                'placeholder' => 'Entre com a descricao'
            )
        ));
               
                
        $ativos = new Select();
        $ativos->setName('controlador')
                       ->setOptions(array('value_options'=>$this->arraycontrollers));
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
