<?php

namespace Ponto\Service;

abstract class AbstractService 
{
    /**
     * @var EntityManager
     */
    protected $entityManager;
    
    protected $entity;
    
    public function __construct(\Doctrine\ORM\EntityManager $entityManager) 
    {
        $this->entityManager = $entityManager;
    }
    
    public function inserir(array $data) 
    {
        $objectEntity = new $this->entity();
        $objectEntity->populate($data);
        
        $this->entityManager->persist($objectEntity);
        $this->entityManager->flush();
        return $objectEntity;
    }
    
    public function editar(array $data) 
    {
        $objectEntity = $this->entityManager
            ->getReference($this->entity, $data['id']);
        $objectEntity->toArray($data);
        
        $this->entityManager->persist($objectEntity);
        $this->entityManager->flush();
        
        return $objectEntity;
    }
    
    public function remover($id) 
    {
        $objectEntity = $this->entityManager->getReference($this->entity, $id);
        if($objectEntity) {
            $this->entityManager->remove($objectEntity);
            $this->entityManager->flush();
            return $id;
        }
    }
    
    public function alterarStatus($id)
    {
        $entity = $this->entity;
        $objectEntity = $this->entityManager->getReference($this->entity, $id);
        
        $status["status"] = $entity::STATUS_ATIVO;
        if ($objectEntity->__get("status") === $entity::STATUS_ATIVO) {
            $status["status"] = $entity::STATUS_INATIVO;
        }
        $objectEntity->populate($status);
        
        $this->entityManager->persist($objectEntity);
        $this->entityManager->flush();
    
        return $objectEntity;
    }
}
