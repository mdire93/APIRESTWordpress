<?php

namespace App\Entity;

use App\Repository\PrestamoclienteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=PrestamoclienteRepository::class)
 */
class Prestamocliente
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_prestamo;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_cliente;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getIdPrestamo(): ?int
    {
        return $this->id_prestamo;
    }

    public function setIdPrestamo(int $id_prestamo): self
    {
        $this->id_prestamo = $id_prestamo;

        return $this;
    }

    public function getIdCliente(): ?int
    {
        return $this->id_cliente;
    }

    public function setIdCliente(int $id_cliente): self
    {
        $this->id_cliente = $id_cliente;

        return $this;
    }
}
