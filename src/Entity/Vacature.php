<?php

namespace App\Entity;

use App\Repository\VacatureRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity(repositoryClass=VacatureRepository::class)
 */
class Vacature
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
     * @ORM\Column(type="string", length=50)
     */
    private $titel;

    /**
     * @ORM\ManyToOne(targetEntity=user::class, inversedBy="vacatures")
     * @ORM\JoinColumn(nullable=false)
     */
    private $bedrijf;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $standplaats;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $niveau;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $bedrijf_logo;

    /**
     * @ORM\ManyToOne(targetEntity=Platform::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $platform;

    /**
     * @ORM\Column(type="text")
     */
    private $beschrijving;

    /**
     * @ORM\OneToMany(targetEntity=Solicitatie::class, mappedBy="vacature_id", orphanRemoval=true)
     */
    private $solicitaties;

    public function __construct()
    {
        $this->solicitaties = new ArrayCollection();
    }

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

    public function getTitel(): ?string
    {
        return $this->titel;
    }

    public function setTitel(string $titel): self
    {
        $this->titel = $titel;

        return $this;
    }

    public function getBedrijf(): ?user
    {
        return $this->bedrijf;
    }

    public function setBedrijf(?user $bedrijf): self
    {
        $this->bedrijf = $bedrijf;

        return $this;
    }

    public function getStandplaats(): ?string
    {
        return $this->standplaats;
    }

    public function setStandplaats(string $standplaats): self
    {
        $this->standplaats = $standplaats;

        return $this;
    }

    public function getNiveau(): ?string
    {
        return $this->niveau;
    }

    public function setNiveau(string $niveau): self
    {
        $this->niveau = $niveau;

        return $this;
    }

    public function getBedrijfLogo(): ?string
    {
        return $this->bedrijf_logo;
    }

    public function setBedrijfLogo(string $bedrijf_logo): self
    {
        $this->bedrijf_logo = $bedrijf_logo;

        return $this;
    }

    public function getPlatformLogo(): ?string
    {
        return $this->platform_logo;
    }

    public function setPlatformLogo(string $platform_logo): self
    {
        $this->platform_logo = $platform_logo;

        return $this;
    }

    public function getBeschrijving(): ?string
    {
        return $this->beschrijving;
    }

    public function setBeschrijving(string $beschrijving): self
    {
        $this->beschrijving = $beschrijving;

        return $this;
    }

    /**
     * @return Collection|Solicitatie[]
     */
    public function getSolicitaties(): Collection
    {
        return $this->solicitaties;
    }

    public function addSolicitaty(Solicitatie $solicitaty): self
    {
        if (!$this->solicitaties->contains($solicitaty)) {
            $this->solicitaties[] = $solicitaty;
            $solicitaty->setVacatureId($this);
        }

        return $this;
    }

    public function removeSolicitaty(Solicitatie $solicitaty): self
    {
        if ($this->solicitaties->removeElement($solicitaty)) {
            // set the owning side to null (unless already changed)
            if ($solicitaty->getVacatureId() === $this) {
                $solicitaty->setVacatureId(null);
            }
        }

        return $this;
    }
}
