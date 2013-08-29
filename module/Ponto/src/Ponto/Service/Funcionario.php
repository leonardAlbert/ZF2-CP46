<?php

namespace Ponto\Service;

class Funcionario extends AbstractService 
{
    public function __construct(\Doctrine\ORM\EntityManager $entityManager) 
    {
        parent::__construct($entityManager);
        
        $this->entity = "\Ponto\Entity\Funcionario";
    }
    
    public function editar(array $dados) 
    {
        $entity = $this->entityManager
            ->getReference($this->entity, $dados['id']);

        if (empty($dados['senha'])) {
            unset($dados['senha']);
        }
        
        $entity->populate($dados);
        
        $this->entityManager->persist($entity);
        $this->entityManager->flush();
        
        return $entity;
    }
}
