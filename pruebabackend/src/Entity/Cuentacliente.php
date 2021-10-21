<?php

namespace App\Entity;

use App\Repository\CuentaclienteRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=CuentaclienteRepository::class)
 */
class Cuentacliente
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
    private $id_cliente;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_cuenta;

    public function getId(): ?int
    {
        return $this->id;
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

    public function getIdCuenta(): ?int
    {
        return $this->id_cuenta;
    }

    public function setIdCuenta(int $id_cuenta): self
    {
        $this->id_cuenta = $id_cuenta;

        return $this;
    }
}
