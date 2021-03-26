<?php

namespace App\Entity;

use App\Repository\SolicitatieRepository;
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
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="solicitaties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity=vacature::class, inversedBy="solicitaties")
     * @ORM\JoinColumn(nullable=false)
     */
    private $vacature;

    /**
     * @ORM\Column(type="boolean")
     */
    private $uitgenodigd;

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

    public function getUser(): ?user
    {
        return $this->user;
    }

    public function setUserId(?user $user): self
    {
        $this->user = $user;

        return $this;
    }

    public function getVacature(): ?vacature
    {
        return $this->vacature;
    }

    public function setVacature(?vacature $vacature): self
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
