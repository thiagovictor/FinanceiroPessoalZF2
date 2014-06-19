<?php


namespace Financeiro\Form;

use Zend\InputFilter\InputFilter;

class CartaoFilter extends InputFilter{
    public function __construct() {
        $this->add(array(
           'name' => 'descricao',
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options'=>array(
                        'messages' => array('isEmpty'=>'Nome do Cartão não pode estar em branco'),
                    )
                )
            )
        ));
        
        $this->add(array(
           'name' => 'vencimento',
            'required' => true,
        ));
    }
    
}
