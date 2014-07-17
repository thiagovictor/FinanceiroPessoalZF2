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
        $date = new \Zend\Validator\Date(array('format'=>'d/m/Y'));
        
        /*
         * Validação do valor
         */
        $valor = new \Zend\InputFilter\Input("valor");
        $valor->setRequired(true)
                ->getValidatorChain()
                ->attach($validadorFloat)
                ->attach($validadorEmpty);
        $this->add($valor);
        /*
         * Validação da descrição
         */
        $descricao = new \Zend\InputFilter\Input("descricao");
        $descricao->setRequired(true)
                ->getFilterChain()
                ->attach($stringTrim)
                ->attach($stripTags);
        $descricao
                ->getValidatorChain()
                ->attach($validadorEmpty);
        $this->add($descricao);
        
        /*
         * Validação das datas
         */
        $vencimento = new \Zend\InputFilter\Input("vencimento");
        $vencimento->setRequired(true)
                ->getValidatorChain()
                ->attach($date);
        $this->add($vencimento);
        
    }
}
