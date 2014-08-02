<?php

namespace Financeiro\Form;

use Zend\Form\Form;
use Zend\Form\Element\Select;

class LancamentosForm extends Form{
    
    protected $centrocusto;
    protected $periodo;
    protected $cartegoria;
    protected $conta;
    protected $favorecido;
    protected $cartao;
    protected $tipo;
    protected $options;
    protected $tipo_registro;


    public function __construct(array $options = null, $name = 'Lancamentos') {
        parent::__construct($name);
        
        $this->centrocusto = new Select();
        $this->periodo = new Select();
        $this->cartegoria = new Select();
        $this->conta = new Select();
        $this->favorecido = new Select();
        $this->cartao = new Select();
        $this->tipo = new Select();
        $this->tipo_registro = new Select();
        $this->options = $options;
        
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new LancamentosFilter());
        $this->setName('Lancamentos');
        
        $this->add(array(
           'name' =>'id',
            'options' => array(
                'type' => 'hidden',
            ),
           
        ));
        
        $this->add(array(
           'name' =>'user_id',
            'options' => array(
                'type' => 'hidden',
            ),
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Text',
            'name' => 'descricao',
            'attributes' => array(
                'id' => 'descricao',
                'placeholder' => 'Entre com o nome'
            )
        ));
        
        $this->add(array(
           'name' => 'valor',
            'options' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'id' => 'valor',
                'placeholder' => 'Entre com o valor'
            )
        ));
        
        $this->add(array(
           'name' => 'vencimento',
            'options' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'id' => 'vencimento',
                'placeholder' => 'Entre com o vencimento'
            )
        ));
        
        $this->add(array(
           'name' => 'pagamento',
            'options' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'id' => 'pagamento',
                'placeholder' => 'Entre com o pagamento'
            )
        ));
        
        $this->add(array(
           'name' => 'parcelas',
            'options' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'id' => 'parcelas',
                'placeholder' => 'Entre com o numero de parcelas'
            )
        ));
        
        $this->add(array(
            'type' => 'Zend\Form\Element\Checkbox',
            'name' => 'status',
            'options' => array(
                'label' => 'Registro Pago?',
                'use_hidden_element' => true,
                'checked_value' => '1',
                'unchecked_value' => '0'
            )
        ));
        
        $this->add(array(
           'name' => 'documento',
            'options' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'id' => 'documento',
                'placeholder' => 'Entre com o documento'
            )
        ));
        
        $date = new \DateTime("now");
        $this->add(array(
           'name' => 'competencia',
            'options' => array(
                'type' => 'text',
            ),
            'attributes' => array(
                'id' => 'conpetencia',
                'placeholder' => 'Mês de competência',
                'value' => $date->format("m/Y")
            )
        ));
        
        $this->tipo_registro->setName('tipo_registro')
                ->setOptions(array('value_options'=>array("on"=>"DESPESA","off"=>"RECEITA")));
        $this->add($this->tipo_registro);
        
        $this->centrocusto->setName('centrocusto')
                       ->setOptions(array('value_options'=>$this->options['centrocusto']));
        $this->add($this->centrocusto);
        
        $this->cartegoria->setName('cartegoria')
                       ->setOptions(array('value_options'=>$this->options['cartegoria']));
        $this->add($this->cartegoria);
        
        $this->periodo->setName('periodo')
                       ->setOptions(array('value_options'=>$this->options['periodo']));
        $this->add($this->periodo);
        
        $this->conta->setName('conta')
                       ->setOptions(array('value_options'=>$this->options['conta']));
        $this->add($this->conta);
        
        $this->favorecido->setName('favorecido')
                       ->setOptions(array('value_options'=>$this->options['favorecido']));
        $this->add($this->favorecido);
        
        $this->cartao->setName('cartao')
                       ->setOptions(array('value_options'=>$this->options['cartao']));
        $this->add($this->cartao);
        
        $this->tipo->setName('tipo')
                       ->setOptions(array('value_options'=>$this->options['tipo']))
                        ->setAttribute("onchange", 'exibeTipo()')
                ->setAttribute("id","tipo_id");
        $this->add($this->tipo);
        
        
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
