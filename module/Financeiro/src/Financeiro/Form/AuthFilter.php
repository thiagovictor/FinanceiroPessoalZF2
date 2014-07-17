<?php


namespace Financeiro\Form;

use Zend\InputFilter\InputFilter;

class AuthFilter extends InputFilter{
    public function __construct() {
        $this->add(array(
            'name' => 'email',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'name' => 'EmailAddress',
                    'name' => 'StringLength',
                    'options' => array(
                        'max'=> 100,
                    )
                )
            ),
        ));
        $this->add(array(
            'name' => 'password',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'max'=> 25,
                    )
                )
            ),
        ));
    }
}


