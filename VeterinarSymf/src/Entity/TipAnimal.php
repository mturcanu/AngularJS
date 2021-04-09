<?php

namespace App\Entity;

use App\Repository\TipAnimalRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=TipAnimalRepository::class)
 */
class TipAnimal
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
     * @ORM\OneToMany(targetEntity=LucrariEfectuate::class, mappedBy="tip", orphanRemoval=true)
     */
    private $Lucrari;

    public function __construct()
    {
        $this->Lucrari = new ArrayCollection();
    }

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

    /**
     * @return Collection|LucrariEfectuate[]
     */
    public function getLucrari(): Collection
    {
        return $this->Lucrari;
    }

    public function addLucrari(LucrariEfectuate $lucrari): self
    {
        if (!$this->Lucrari->contains($lucrari)) {
            $this->Lucrari[] = $lucrari;
            $lucrari->setTip($this);
        }

        return $this;
    }

    public function removeLucrari(LucrariEfectuate $lucrari): self
    {
        if ($this->Lucrari->removeElement($lucrari)) {
            // set the owning side to null (unless already changed)
            if ($lucrari->getTip() === $this) {
                $lucrari->setTip(null);
            }
        }

        return $this;
    }
}
