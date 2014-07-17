<?php


namespace Financeiro\Form;

use Zend\InputFilter\InputFilter;

class ContaFilter extends InputFilter{
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
                    'name'=>'StringLength',
                    'options' => array(
                        'max' => 50,
                    )
                )
            )
        ));
        
        /*
        Funcionando
        $validatorFloat = new \Zend\I18n\Validator\Float(array('locale' => 'pt_br'));
        $validatorFloat->setMessage("Campo deve ser Float", \Zend\I18n\Validator\Float::NOT_FLOAT);
        $this->add(array(
            'name' => 'saldo',
            'required' => true,
            'validators' => array($validatorFloat)
        ));*/

        $this->add(array(
            'name' => 'saldo',
            'required' => true,
            'validators' => array(
                array(
                    'name' => 'Float',
                    'options'=>array(
                        'locale'=>'pt_br',
                        'messages' => array(
                            'floatInvalid'=>'Tipo de dado inválido',
                            'notFloat'=>'O valor deve ser numérico tipo modeda. ex. 1.500,00',
                        ),
                    )
                ),
                array(
                    'name' => 'NotEmpty',
                    'options'=>array(
                        'messages' => array('isEmpty'=>'Valor não pode estar em branco'),
                    )
                )
            )
        ));
    }
    
}
