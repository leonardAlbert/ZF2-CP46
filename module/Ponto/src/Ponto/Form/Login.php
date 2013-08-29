<?php

namespace Ponto\Form;

use Zend\Form\Form;

class Login extends Form 
{
    
    public function __construct($name = null) {
        parent::__construct('login');
        $this->setAttribute('method', 'post');
        $this->setInputFilter(new \Ponto\Form\LoginFilter());
        
        $this->add(array(
            'name' => 'id',
            'attributes' => array(
                'type'  => 'hidden',
                'class'  => "form-control",
            ),
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
           'name' => 'submit',
            'type' => 'Submit',
            'attributes' => array(
                'value' => "Let's Rock!",
                'class' => 'btn btn-success'
            )
        ));
    }
}
