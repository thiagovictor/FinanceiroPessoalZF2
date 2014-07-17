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
                    'options'=>array(
                        'messages' => array('isEmpty'=>'Nome do usuário não pode estar em branco'),
                    )
                )
            )
        ));
        
        $this->add(array(
            'name' => 'email',
            'required' => true,
            'filters' => array(
                array('name'=>'StripTags'),
                array('name'=>'StringTrim')
            ),
            'validators' => array(
                array(
                    'name' => 'EmailAddress',
                )
            )
        ));
        
    }  
}
