<?php

namespace CodeEmailMKT\Entity;

use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 * @ORM\Table(name="clientes")
 */
class Clientes
{
    /**
     * @ORM\Id
     * @ORM\Column(type="integer");
     * @ORM\GeneratedValue(strategy="AUTO")
     */
    protected $id;

    /**
     * @ORM\Column(type="string", nullable=true, length=50)
     */
    protected $nome;
	
    /**
     * @ORM\Column(type="string", nullable=true, length=100)
     */
    protected $email;
	
    /**
     * @ORM\Column(type="string", nullable=true, length=11)
     */
    protected $cpf;	

    /**
     * @return int|null
     */
    public function getId()
    {
        return $this->id;
    }

    public function setNome($nome)
    {
        $this->nome = $nome;

        return $this;
    }

    public function getNome()
    {
        return $this->nome;
    }
	
    public function setEmail($email)
    {
        $this->email = $email;

        return $this;
    }

    public function getEmail()
    {
        return $this->email;
    }
	
    public function setCpf($cpf)
    {
        $this->cpf = $cpf;

        return $this;
    }

    public function getCpf()
    {
        return $this->cpf;
    }		
	
}