<?php

namespace App\Entity;

use App\Repository\PrestamosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrestamosRepository::class)
 */
class Prestamos
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
    private $nombre;
    /**
     * @ORM\Column(type="string", length=500)
     */
    private $cantidad;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $duracion;
    /**
     * @ORM\Column(type="string", length=500)
     */
    private $tae;  
    /**
    * @ORM\Column(type="string", length=500)
    */
   private $devolver;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNombre(): ?string
    {
        return $this->nombre;
    }

    public function setNombre(string $nombre): self
    {
        $this->cantidad = $nombre;

        return $this;
    }
    public function getCantidad(): ?string
    {
        return $this->cantidad;
    }

    public function setCantidad(string $cantidad): self
    {
        $this->cantidad = $cantidad;

        return $this;
    }
    
    public function getDuracion(): ?string
    {
        return $this->duracion;
    }

    public function setDuracion(string $duracion): self
    {
        $this->duracion = $duracion;

        return $this;
    }
    public function getTae(): ?string
    {
        return $this->tae;
    }

    public function setTae(string $tae): self
    {
        $this->tae = $tae;

        return $this;
    }
    public function getDevolver(): ?string
    {
        return $this->devolver;
    }

    public function setDevolver(string $devolver): self
    {
        $this->devolver = $devolver;

        return $this;
    }
}
