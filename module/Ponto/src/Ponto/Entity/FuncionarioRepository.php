<?php

namespace Ponto\Entity;

use Doctrine\ORM\EntityRepository;

class FuncionarioRepository extends EntityRepository 
{
    public function findAllToArray()
    {
        $findAll = parent::findAll();
    
        if (empty($findAll)) {
            return $findAll;
        }

        foreach ($findAll as &$object) {
            $object = $object->toArray();
        }
        
        return $findAll;
    }
    
    public function findByUsuarioSenha($usuario, $senha)
    {
        $funcionario = $this->findOneBy(array("usuario" => $usuario, 
            "status" => \Ponto\Entity\Funcionario::STATUS_ATIVO));
        
        if ($funcionario) {
            $hashSenha = $funcionario->encryptPassword($senha);
    
            if ($hashSenha == $funcionario->__get("senha")) {
                return $funcionario;
            }
        }
    
        return false;
    }
}