<?php

namespace Ponto\Form;

use Zend\Form\Form;

class Funcionario extends Form {
    
    public function __construct($name = null) {
        parent::__construct('funcionario');
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new \Ponto\Form\FuncionarioFilter());
        
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
                'class'  => "form-control",
            ),
        ));
        
        $this->add(array(
            'name' => 'nome',
            'options' => array(
                'label' => 'Nome'
            ),
            'attributes' => array(
                'id'        => 'nome',
                'maxlength' => '60',
                'class'     => "form-control",
                'type'      => 'text',
                'placeholder' => 'Entre com o nome'
            )
        ));
        
        $this->add(array(
            'name' => 'usuario',
            'options' => array(
                'label' => 'Usuário'
            ),
            'attributes' => array(
                'id'        => 'usuario',
                'maxlength' => '60',
                'class'     => "form-control",
                'type'      => 'text',
                'placeholder' => 'Entre com o usuário'
            )
        ));
        
        $this->add(array(
            'name' => 'email',
            'options' => array(
                'label' => 'E-mail'
            ),
            'attributes' => array(
                'id'        => 'email',
                'maxlength' => '80',
                'class'     => "form-control",
                'type'      => 'email',
                'placeholder' => 'Entre com o e-mail'
            )
        ));
        
        $this->add(array(
            'name' => 'area',
            'options' => array(
                'label' => 'Área'
            ),
            'attributes' => array(
                'id'        => 'area',
                'maxlength' => '80',
                'class'     => "form-control",
                'type'      => 'text',
                'placeholder' => 'Entre com o nome'
            )
        ));
        
        $this->add(array(
            'name' => 'departamento',
            'options' => array(
                'label' => 'Departamento'
            ),
            'attributes' => array(
                'id'        => 'departamento',
                'maxlength' => '80',
                'class'     => "form-control",
                'type'      => 'text',
                'placeholder' => 'Entre com o departamento'
            )
        ));
        
        $this->add(array(
            'name' => 'funcao',
            'options' => array(
                'label' => 'Função'
            ),
            'attributes' => array(
                'id'        => 'funcao',
                'maxlength' => '80',
                'class'     => "form-control",
                'type'      => 'text',
                'placeholder' => 'Entre com a função'
            )
        ));
        
        $this->add(array(
           'name' => 'senha',
            'options' => array(
                'label' => 'Senha'
            ),
            'attributes' => array(
                'id' => 'senha',
                'maxlength' => '30',
                'type' => 'Password',
                'class' => "form-control",
                'type' => 'password',
                'placeholder' => 'Entre com a senha',
            )
        ));
        
        $this->add(array(
            'name' => 'permissao',
            'type' => 'Select',
            'attributes' => array(
                'id'    => 'permissao',
                'class' => "form-control",
                'placeholder' => 'Entre com a permissão',
            ),
            'options' => array(
                'label'         => 'Tipo',
                'empty_option'  => 'Selecione...',
                'value_options' => array(
                    \Ponto\Entity\Funcionario::PERMISSAO_USUARIO => "Usuário",
                    \Ponto\Entity\Funcionario::PERMISSAO_ADMIN   => "Administrador",
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'status',
            'type' => 'Zend\Form\Element\Checkbox',
            'attributes' => array(
                'class' => "form-control",
            ),
            'options' => array(
                'label' => 'Status',
                'use_hidden_element' => true,
                'checked_value'      => '1',
                'unchecked_value'    => '0'
            )
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
