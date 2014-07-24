<?php


namespace Financeiro\Form;

use Zend\InputFilter\InputFilter;

class UserFilter extends InputFilter{
    public function __construct() {
        $this->add(array(
           'name' => 'username',
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'NotEmpty',
                    'name' => 'StringLength',
                    'options' => array(
                        'max'=> 120,
                    )
                )
            )
        ));
        $EmailAddress = new \Zend\Validator\EmailAddress();
        $NotEmpty = new \Zend\Validator\NotEmpty();
        $StringLength = new \Zend\Validator\StringLength();
        $StringLength->setMax(100);
        $StringLength11 = new \Zend\Validator\StringLength();
        $StringLength11->setMax(11);
        $Digits = new \Zend\Validator\Digits();
        
        $this->add(array(
            'name' => 'email',
            'required' => true,
            'filters' => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim')
            ),
            'validators' => array(
                $EmailAddress,
                $NotEmpty,
                $StringLength
            ),
        ));
        $this->add(array(
            'name' => 'password',
            'required' => false,
            'validators' => array(
                array(
                    'name' => 'StringLength',
                    'options' => array(
                        'max'=> 25,
                    )
                )
            ),
        ));
        
        
        
        
        $this->add(array(
           'name' => 'telefone',
            'required' => false,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validators' => array(
                $Digits,
                $StringLength11,
                $NotEmpty
            )
        ));
        $this->add(array(
           'name' => 'celular',
            'required' => false,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validators' => array(
                $Digits,
                $StringLength11,
                $NotEmpty
            )
        ));
        
    }  
}
