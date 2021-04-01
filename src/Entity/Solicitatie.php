<?php

namespace App\Entity;

use App\Repository\SolicitatieRepository;
use App\Entity\User;
use App\Entity\Vacature;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=SolicitatieRepository::class)
 */
class Solicitatie
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="datetime")
     */
    private $datum;

    /**
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="solicitaties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=Vacature::class, inversedBy="solicitaties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vacature;

    /**
     * @ORM\Column(type="boolean")
     */
    private $uitgenodigd=false;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDatum(): ?\DateTimeInterface
    {
        return $this->datum;
    }

    public function setDatum(\DateTimeInterface $datum): self
    {
        $this->datum = $datum;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getVacature(): ?Vacature
    {
        return $this->vacature;
    }

    public function setVacature(?Vacature $vacature): self
    {
        $this->vacature = $vacature;

        return $this;
    }

    public function getUitgenodigd(): ?bool
    {
        return $this->uitgenodigd;
    }

    public function setUitgenodigd(bool $uitgenodigd): self
    {
        $this->uitgenodigd = $uitgenodigd;

        return $this;
    }
}
