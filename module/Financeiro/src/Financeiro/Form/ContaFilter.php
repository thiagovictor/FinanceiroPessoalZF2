<?php


namespace Financeiro\Form;

use Zend\InputFilter\InputFilter;

class ContaFilter extends InputFilter{
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
                        'messages' => array('isEmpty'=>'Descrição da Conta não pode estar em branco'),
                    )
                )
            )
        ));
        $this->add(array(
           'name' => 'saldo',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'Float',
                    'options'=>array(
                        'messages' => array('notFloat'=>'Saldo deve estar no Formato 0.000,00'),
                        'min'=>0,
                    )
                )
            )
        ));
    }
    
}
