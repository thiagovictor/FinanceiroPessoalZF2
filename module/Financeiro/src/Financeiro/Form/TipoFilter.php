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
                    'name' => 'StringLength',
                    'options'=>array(
                        'max' => 25,
                    )
                )
            )
        ));
        
        $this->add(array(
           'name' => 'javascript',
            'required' => false,
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options'=>array(
                        'max' => 200,
                    )
                )
            )
        ));
    }
    
}
