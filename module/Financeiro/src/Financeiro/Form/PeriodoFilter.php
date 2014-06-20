<?php


namespace Financeiro\Form;

use Zend\InputFilter\InputFilter;

class PeriodoFilter extends InputFilter{
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
                        'messages' => array('isEmpty'=>'Nome do Periodo não pode estar em branco'),
                    )
                )
            )
        ));
    }
    
}
