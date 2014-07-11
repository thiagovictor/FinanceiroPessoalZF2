<?php


namespace Financeiro\Form;

use Zend\InputFilter\InputFilter;
use Zend\Filter\StringTrim,
    Zend\Filter\StripTags;
use Zend\Validator\NotEmpty;

class CartaoFilter extends InputFilter{
    public function __construct() {
        $StripTags = new StripTags();
        $StringTrim = new StringTrim();
        $NotEmpty = new NotEmpty();
        $NotEmpty->setMessage("Nome do Cartão não pode estar em branco", NotEmpty::IS_EMPTY);
        $this->add(array(
           'name' => 'descricao',
            'required' => true,
            'filters' => array($StringTrim, $StripTags),
            'validators' => array($NotEmpty),
        ));
        
        $this->add(array(
           'name' => 'vencimento',
            'required' => true,
        ));
    }
    
}
