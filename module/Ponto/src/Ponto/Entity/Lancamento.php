<?php

namespace Ponto\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * Lancamento
 * 
 * @ORM\Entity 
 * @ORM\Table(name="lancamento")
 * ORM\Entity(repositoryClass="Radio\Entity\LoginRepository")
 * @property int $id
 * @property int $funcionario
 * @property datetime $data_hora
 * @property int $tipo
 * 
 */
class Lancamento extends \Ponto\Entity\AbstractEntity
{
    const TIPO_ENTRADA   = 0;
    
    const TIPO_INTERVALO = 1;
    
    const TIPO_RETORNO   = 2;
    
    const TIPO_SAIDA     = 3;
    
    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     * @var int
     */
    protected $id;
    
    /**
     * @ORM\OneToOne(targetEntity="Ponto\Entity\Funcionario")
     * @ORM\JoinColumn(name="funcionario", referencedColumnName="id")
     */
    protected $funcionario;
    
    /**
     * @ORM\Column(type="datetime")
     */
    protected $data_hora;
    
    /**
     * @ORM\Column(type="integer")
     * @var int
     */
    protected $tipo;
    
}