<?php


namespace Financeiro\Form;

use Zend\Form\Form;


class AtivoForm extends Form{
    
   
    
    public function __construct($name = null) {
        parent::__construct($name);
        
        $this->params();
    }
    public function params(){
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new AtivoFilter);
        $this->setName('Ativo');
        
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
                'placeholder' => 'Entre com o nome do status'
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
