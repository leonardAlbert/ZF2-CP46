<?php

namespace Ponto\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Funcionario
 * 
 * @ORM\Entity 
 * @ORM\Table(name="funcionario")
 * @ORM\Entity(repositoryClass="Ponto\Entity\FuncionarioRepository")
 * @property int $id
 * @property string $nome
 * @property string $email
 * @property string $usuario
 * @property string $senha
 * @property string $salt
 * @property int $status
 * @property int $permissao
 * @property string $area
 * @property string $departamento
 * @property string $funcao
 * 
 */
class Funcionario extends \Ponto\Entity\AbstractEntity
{
    
    /**
     *
     * @var unknown_type
     */
    const PERMISSAO_USUARIO = 0;
    
    /**
     *
     * @var unknown_type
     */
    const PERMISSAO_ADMIN = 1;
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $nome;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $email;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $usuario;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $senha;
    
    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $status = self::STATUS_ATIVO;
    
    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $permissao = self::PERMISSAO_USUARIO;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $area;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $departamento;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $funcao;
    
    /**
     * @ORM\Column(type="text")
     * @var string
     */
    protected $salt;
    
    public function __set($property, $value)
    {
        if ($property === "senha") {
            $value = $this->encryptPassword($value);
        }
        
        return parent::__set($property, $value);
    }
    
    public function __get($property)
    {
        if ($property === "salt" && empty($this->$property)) {
            $this->$property = base_convert(sha1(uniqid(mt_rand(), true)), 16, 36);
        }
        
        return parent::__get($property);
    }
    
    public function encryptPassword($senha) 
    {
        $hashSenha = hash("sha512", "{$senha}{$this->__get("salt")}");
        
        for ($i = 0; $i < 64000; $i++) {
            $hashSenha = hash('sha512', $hashSenha);
        }
    
        return $hashSenha;
    }
    
}