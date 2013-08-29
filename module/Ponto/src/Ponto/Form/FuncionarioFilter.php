<?php

namespace Ponto\Form;

use Zend\InputFilter\InputFilter;

class FuncionarioFilter extends InputFilter
{
    protected $messageEmpty          = 'O valor é obrigatório e não pode estar vazio';
    protected $messageTooShortString = 'O tamanho do valor de entrada é inferior a %min% caracteres';
    protected $messageTooLoongString = 'O tamanho do valor de entrada é superior a %max% caracteres';
    
    public function __construct()
    {
        /*
        $this->add(array(
            'name' => 'usuario',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
                array('name' => 'StringToLower'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 3,
                        'max'      => 30,
                        'messages' => array(
                            'stringLengthTooShort' => $this->messageTooShortString,
                            'stringLengthTooLong'  => $this->messageTooLoongString,
                        ),
                    ),
                ),
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => $this->messageEmpty,
                        ),
                    ),
                ),
            ),
        ));
        
        $this->add(array(
            'name' => 'senha',
            'required' => true,
            'filters'  => array(
                array('name' => 'StripTags'),
                array('name' => 'StringTrim'),
            ),
            'validators' => array(
                array(
                    'name'    => 'StringLength',
                    'options' => array(
                        'encoding' => 'UTF-8',
                        'min'      => 3,
                        'max'      => 30,
                        'messages' => array(
                            'stringLengthTooShort' => $this->messageTooShortString,
                            'stringLengthTooLong'  => $this->messageTooLoongString,
                        ),
                    ),
                ),
                array(
                    'name' => 'NotEmpty',
                    'options' => array(
                        'messages' => array(
                            'isEmpty' => $this->messageEmpty,
                        ),
                    ),
                ),
            ),
        ));
        */
    }    
}