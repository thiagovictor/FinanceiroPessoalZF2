<?php


namespace Financeiro\Form;

use Zend\InputFilter\InputFilter;

class TipoFilter extends InputFilter{
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
        
        $this->add(array(
           'name' => 'javascript',
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'options'=>array(
                        'messages' => array('isEmpty'=>'Script não pode ficar em branco'),
                    )
                )
            )
        ));
    }
    
}
