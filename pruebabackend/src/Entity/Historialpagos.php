<?php

namespace App\Entity;

use App\Repository\HistorialpagosRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=HistorialpagosRepository::class)
 */
class Historialpagos
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
    private $id_cuenta;

    /**
     * @ORM\Column(type="integer")
     */
    private $id_cuentacliente;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $cantidad;

    /**
     * @ORM\Column(type="string", length=500)
     */
    private $fecha;
    
    /**
     * @ORM\Column(type="string", length=500)
     */
    private $operacion;


    public function getId(): ?int
    {
        return $this->id;
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
    public function getIdCuentacliente(): ?int
    {
        return $this->id_cuentacliente;
    }

    public function setIdCuentacliente(int $id_cuentacliente): self
    {
        $this->id_cuentacliente = $id_cuentacliente;

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

    public function getFecha(): ?string
    {
        return $this->fecha;
    }

    public function setFecha(string $fecha): self
    {
        $this->fecha = $fecha;

        return $this;
    }
    
    public function getOperacion(): ?string
    {
        return $this->operacion;
    }

    public function setOperacion(string $operacion): self
    {
        $this->operacion = $operacion;

        return $this;
    }
}
