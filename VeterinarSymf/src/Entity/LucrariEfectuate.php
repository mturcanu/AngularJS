<?php

namespace App\Entity;

use App\Repository\LucrariEfectuateRepository;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=LucrariEfectuateRepository::class)
 */
class LucrariEfectuate
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $nume;

    /**
     * @ORM\ManyToOne(targetEntity=TipAnimal::class, inversedBy="Lucrari")
     * @ORM\JoinColumn(nullable=false)
     */
    private $tip;

    /**
     * @ORM\Column(type="string", length=255)
     */
    private $imagine;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getNume(): ?string
    {
        return $this->nume;
    }

    public function setNume(string $nume): self
    {
        $this->nume = $nume;

        return $this;
    }

    public function getTip(): ?TipAnimal
    {
        return $this->tip;
    }

    public function setTip(?TipAnimal $tip): self
    {
        $this->tip = $tip;

        return $this;
    }

    public function getImagine(): ?string
    {
        return $this->imagine;
    }

    public function setImagine($imagine): self
    {
        $this->imagine = $imagine;

        return $this;
    }
}
