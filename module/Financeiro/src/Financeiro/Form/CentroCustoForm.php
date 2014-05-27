<?php


namespace Financeiro\Form;

use Zend\Form\Form;

class CentroCustoForm extends Form{
   
    public function __construct($name = null) {
        parent::__construct($name);
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new CentroCustoFilter);
        
        $this->add(array(
           'name' =>'idf_centrocusto',
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
                //'class' => 'input-lg'
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
