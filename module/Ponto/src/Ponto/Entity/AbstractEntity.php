<?php
namespace Ponto\Entity;

use Doctrine\ORM\EntityManager;

use Zend\InputFilter\InputFilter,
    Zend\InputFilter\Factory as InputFactory,
    Zend\InputFilter\InputFilterAwareInterface,
    Zend\InputFilter\InputFilterInterface;

abstract class AbstractEntity implements InputFilterAwareInterface
{
    /**
     * 
     * @var int
     */
    const STATUS_ATIVO   = 1;
    
    /**
     * 
     * @var int
     */
    const STATUS_INATIVO = 0;
    
    /**
     * @var Zend\InputFilter\InputFilter
     */
    protected $inputFilter;
    
    /**
     * @var unknown_type
     */
    protected $serviceLocator;
    
    public function __construct(array $dados = array())
    {
        $this->populate($dados);
        
        return $this;
    }
    
    /**
     * Magic getter to expose protected properties.
     *
     * @param string $property
     * @return mixed
     */
    public function __get($property)
    {
        return $this->$property;
    }
    
    /**
     * Magic setter to save protected properties.
     *
     * @param string $property
     * @param mixed $value
     */
    public function __set($property, $value)
    {
        $this->$property = $value;
        
        return $this;
    }
    
    /**
     * Convert the object to an array.
     *
     * @return array
     */
    public function toArray()
    {
        return get_object_vars($this);
    }
    
    /**
     * Populate from an array.
     *
     * @param array $data
     */
    public function populate(array $data = array())
    {
        foreach ($data as $property => $value) {
            if (property_exists($this, $property)) {
                $this->__set($property, $value);
            }
        }
        
        return $this;
    }
    
    public function setInputFilter(InputFilterInterface $inputFilter)
    {
        $this->inputFilter = $inputFilter;
    }
    
    public function getInputFilter()
    {
         return $this->inputFilter;
    }

    public function setServiceLocator($serviceLocator)
    {
        $this->serviceLocator = $serviceLocator;
        
        return $this;
    }
    
    public function getServiceLocator()
    {
        return $this->serviceLocator;
    }
} 