<?php

namespace App\Entity;

use App\Repository\ClientesRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=ClientesRepository::class)
 */
class Clientes
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $usuario;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $nombre;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $apellidos;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $pass;
    /**
     * @ORM\Column(type="string", length=500)
     */
    private $credencial;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsuario(): ?string
    {
        return $this->usuario;
    }

    public function setUsuario(string $usuario): self
    {
        $this->usuario = $usuario;

        return $this;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->nombre = $nombre;

        return $this;
    }

    public function getApellidos(): ?string
    {
        return $this->apellidos;
    }

    public function setApellidos(string $apellidos): self
    {
        $this->apellidos = $apellidos;

        return $this;
    }

    public function getPass(): ?string
    {
        return $this->pass;
    }

    public function setPass(string $pass): self
    {
        $this->pass = $pass;

        return $this;
    } 
    
    public function getCredencial(): ?string
    {
        return $this->credencial;
    }

    public function setCredencial(string $credencial): self
    {
        $this->credencial = $credencial;

        return $this;
    }
}
