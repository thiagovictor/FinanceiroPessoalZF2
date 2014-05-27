<?php


namespace Financeiro\Form;

use Zend\Form\Form;

class CentroCustoForm extends Form{
   
    public function __construct($name = null) {
        parent::__construct($name);
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new CentroCustoFilter);
        
        $this->add(array(
           'name' =>'id',
            'attibutes' => array(
                'type' => 'hidden'
            )
        ));
        
        $this->add(array(
           'name' => 'descricao',
            'options' => array(
                'type' => 'text',
                'label' => 'Nome:'
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
                'class' => 'btn-success'
            )
        ));
    }
}
