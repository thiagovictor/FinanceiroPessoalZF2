<?php


namespace Financeiro\Form;

use Zend\Form\Form;

class CentrocustoForm extends Form{


    public function __construct( $name = null) {
        parent::__construct($name);
        $this->params();
    }
    public function params(){
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new CentrocustoFilter);
        $this->setName('CentroCusto');
        
        $this->add(array(
           'name' =>'id',
            'options' => array(
                'type' => 'hidden',
            ),  
        ));
                
        $this->add(array(
           'name' => 'descricao',
            'options' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'id' => 'descricao',
                'placeholder' => 'Entre com o nome'
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
