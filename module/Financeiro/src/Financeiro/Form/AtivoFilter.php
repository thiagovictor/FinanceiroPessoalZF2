<?php


namespace Financeiro\Form;

use Zend\InputFilter\InputFilter;

class AtivoFilter extends InputFilter{
    public function __construct() {
        $this->add(array(
           'name' => 'nome',
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options'=>array(
                        'messages' => array('isEmpty'=>'Nome do Status não pode estar em branco'),
                    )
                )
            )
        ));
    }
    
}
