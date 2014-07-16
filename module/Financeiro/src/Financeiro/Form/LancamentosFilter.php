<?php

namespace Financeiro\Form;

class LancamentosFilter extends \Zend\InputFilter\InputFilter {

    public function __construct() {
        $validadorFloat = new \Zend\I18n\Validator\Float();
        $validadorFloat->setMessage("O valor deve ser do tipo moeda :: R$ 1.500,00", \Zend\I18n\Validator\Float::NOT_FLOAT);
        $validadorEmpty = new \Zend\Validator\NotEmpty();
        $validadorEmpty->setMessage("Este campo não pode estar vazio", \Zend\Validator\NotEmpty::IS_EMPTY);
        $stripTags = new \Zend\Filter\StripTags();
        $stringTrim = new \Zend\Filter\StringTrim();
                
        $valor = new \Zend\InputFilter\Input("valor");
        $valor->setRequired(true)
                ->getValidatorChain()
                ->attach($validadorFloat)
                ->attach($validadorEmpty);
        $this->add($valor);
        
        $descricao = new \Zend\InputFilter\Input("descricao");
//        $descricao->getFilterChain()
//                ->attach($stringTrim)
//                ->attach($stripTags);
        $descricao->setRequired(true)
                ->getValidatorChain()
                ->attach($validadorEmpty);
        $this->add($descricao);
    }
}
