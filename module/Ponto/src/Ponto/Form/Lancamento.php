<?php

namespace Ponto\Form;

class Lancamento extends \Zend\Form\Form 
{
    protected $funcionarios;
    
    public function __construct(array $funcionarios = array()) 
    {
        $this->funcionarios = $funcionarios;
        
        parent::__construct('lancamento');
        $this->setAttribute('method', 'post');
        //$this->setInputFilter(new \Ponto\Form\LancamentoFilter());
        
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
                'class'  => "form-control",
            ),
        ));
        
        $this->add(array(
            'name' => 'funcionario',
            'type' => 'Select',
            'attributes' => array(
                'id'    => 'funcionarios',
                'class' => "form-control",
                'placeholder' => 'Entre com o funcionário',
            ),
            'options' => array(
                'label'         => 'Funcionário',
                'value_options' => $this->funcionarios,
                'empty_option'  => 'Selecione...',
            ),
        ));
        
        $this->add(array(
            'name' => 'data_hora',
            'options' => array(
                'label' => 'Data/Hora'
            ),
            'attributes' => array(
                'id'        => 'data_hora',
                'maxlength' => '60',
                'class'     => "form-control",
                'type'      => 'text',
                'readonly'  => 'readonly',
                'placeholder' => 'Entre com o nome'
            )
        ));
        
        $this->add(array(
            'name' => 'tipo',
            'type' => 'Select',
            'attributes' => array(
                'id'    => 'tipo',
                'class' => "form-control",
                'placeholder' => 'Entre com o tipo',
            ),
            'options' => array(
                'label'         => 'Tipo',
                'empty_option'  => 'Selecione...',
                'value_options' => array(
                    \Ponto\Entity\Lancamento::TIPO_ENTRADA   => "Entrada",
                    \Ponto\Entity\Lancamento::TIPO_INTERVALO => "Intervalo",
                    \Ponto\Entity\Lancamento::TIPO_RETORNO   => "Retorno",
                    \Ponto\Entity\Lancamento::TIPO_SAIDA     => "Saida",
                ),
            ),
        ));
        
        $this->add(array(
           'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => 'Enviar',
                'class' => 'btn btn-success'
            )
        ));
    }
}
