<?php


namespace Financeiro\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

class CartegoriaForm extends Form{
    
    protected $arraycentrocusto;
    
    public function __construct(array $arraycentrocusto = null, $name = null) {
        parent::__construct($name);
        $this->arraycentrocusto = $arraycentrocusto;
        $this->params();
    }
    public function params(){
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new CartegoriaFilter);
        $this->setName('Cartegoria');
        
        $this->add(array(
           'name' =>'id',
            'options' => array(
                'type' => 'hidden',
            ),
           
        ));
        
        $this->add(array(
           'name' =>'user_id',
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
        
                
        $centrosdecusto = new Select();
        $centrosdecusto->setName('centrocusto')
                       ->setOptions(array('value_options'=>$this->arraycentrocusto));
        $this->add($centrosdecusto);
        
        
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
