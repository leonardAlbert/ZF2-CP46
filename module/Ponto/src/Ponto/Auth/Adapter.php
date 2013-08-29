<?php

namespace Ponto\Auth;

use Zend\Authentication\Adapter\AdapterInterface,
    Zend\Authentication\Result;

use Doctrine\ORM\EntityManager;

class Adapter implements AdapterInterface 
{
    /**
     * 
     * @var unknown_type
     */
    protected $entityManager;
    
    /**
     * 
     * @var unknown_type
     */
    protected $usuario;
    
    /**
     * 
     * @var unknown_type
     */
    protected $senha;
    
    public function __construct(EntityManager $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    
    public function __get($property)
    {
        return $this->$property;
    }
    
    public function __set($property, $value)
    {
        $this->$property = $value;
        
        return $this;
    }
    
    public function authenticate() 
    {
        $repository = $this->entityManager->getRepository("\Ponto\Entity\Funcionario");
        $funcionario = $repository->findByUsuarioSenha(
                $this->__get("usuario"), $this->__get("senha"));
        
        if($funcionario) {
           return new Result(Result::SUCCESS, 
               array('funcionario-sistema' => $funcionario), array('OK'));
        } 

        return new Result(Result::FAILURE_CREDENTIAL_INVALID, null, array());
    }
    
}
