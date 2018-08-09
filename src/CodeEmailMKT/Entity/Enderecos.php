<?php

namespace CodeEmailMKT\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="enderecos")
 */
class Enderecos
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\ManyToOne(targetEntity="Clientes")
	 * @ORM\JoinColumn(name="cliente", referencedColumnName="id")
	 * @ORM\Column(type="integer");
     */
    protected $cliente;

    /**
     * @ORM\Column(type="string", nullable=true, length=8)
     */
    protected $cep;
	
    /**
     * @ORM\Column(type="string", nullable=true, length=255)
     */
    protected $logradouro;
	
    /**
     * @ORM\Column(type="string", nullable=true, length=50)
     */
    protected $cidade;
	
    /**
     * @ORM\Column(type="string", nullable=true, length=2)
     */
    protected $estado;		

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    public function setCliente($cliente)
    {
        $this->cliente = $cliente;
    }
 
    public function getCliente()
    {
        return $this->cliente;
    }

    public function setCep($cep)
    {
        $this->cep = $cep;

        return $this;
    }

    public function getCep()
    {
        return $this->cep;
    }
	
    public function setLogradouro($logradouro)
    {
        $this->logradouro = $logradouro;

        return $this;
    }

    public function getLogradouro()
    {
        return $this->logradouro;
    }
	
    public function setCidade($cidade)
    {
        $this->cidade = $cidade;

        return $this;
    }

    public function getCidade()
    {
        return $this->cidade;
    }
	
    public function setEstado($estado)
    {
        $this->estado = $estado;

        return $this;
    }

    public function getEstado()
    {
        return $this->estado;
    }			
	
}