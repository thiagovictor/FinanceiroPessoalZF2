<?php


namespace Financeiro\Form;

use Zend\InputFilter\InputFilter;
use Zend\Filter\StringTrim,
    Zend\Filter\StripTags;
use Zend\Validator\NotEmpty,
    Zend\Validator\StringLength;

class AtivoFilter extends InputFilter{
    public function __construct() {
        
        /*O modelo abaixo tem a mesma função
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
        ),
        */
        $StripTags = new StripTags();
        $StringTrim = new StringTrim();
        $NotEmpty = new NotEmpty();
        $NotEmpty->setMessage("Nome do Status não pode estar em branco", NotEmpty::IS_EMPTY);
        $StringLength= new StringLength();
        $StringLength->setMax(25);
        $this->add(array(
            'name' => 'nome',
            'required' => true,
            'filters' => array($StripTags,$StringTrim),
            'validators' => array($NotEmpty,$StringLength),
        ));
    }
    
}
