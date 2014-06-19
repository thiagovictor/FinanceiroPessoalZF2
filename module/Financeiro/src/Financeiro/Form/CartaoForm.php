<?php

namespace Financeiro\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

class CartaoForm extends Form {

    public function __construct($name = null) {
        parent::__construct($name);
        $this->params();
    }

    public function params() {
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new CartaoFilter);
        $this->setName('CentroCusto');

        $this->add(array(
            'name' => 'id',
            'options' => array(
                'type' => 'hidden',
            ),
        ));

        $this->add(array(
            'name' => 'descricao',
            'options' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'id' => 'descricao',
                'placeholder' => 'Entre com o nome'
            )
        ));
        $vencimentos = new Select();
        $vencimentos->setName('vencimento')
                ->setOptions(array('value_options' => array(
                        '01' => '01',
                        '02' => '02',
                        '03' => '03',
                        '04' => '04',
                        '05' => '05',
                        '06' => '06',
                        '07' => '07', 
                        '08' => '08',
                        '09' => '09',
                        '10' => '10',
                        '11' => '11',
                        '12' => '12',
                        '13' => '13',
                        '14' => '14',
                        '15' => '15',
                        '16' => '16',
                        '17' => '17',
                        '18' => '18',
                        '19' => '19',
                        '20' => '20',
                        '21' => '21',
                        '22' => '22',
                        '23' => '23',
                        '24' => '24',
                        '25' => '25',
                        '26' => '26',
                        '27' => '27',
                        '28' => '28'
                    )
        ));
        $this->add($vencimentos);

        $this->add(array(
            'name' => 'submit',
            'type' => 'Zend\Form\Element\Submit',
            'attributes' => array(
                'value' => 'Salvar',
                'class' => 'btn btn-success'
            )
        ));
    }

}
