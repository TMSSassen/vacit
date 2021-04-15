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
     * @ORM\ManyToOne(targetEntity=User::class, inversedBy="vacatures")
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
    private $bedrijf_logo="";

    /**
     * @ORM\ManyToOne(targetEntity=Platform::class)
     * @ORM\JoinColumn(nullable=false)
     */
    private $platform;

    /**
     * @ORM\Column(type="text")
     */
    private $beschrijving="";

    /**
     * @ORM\OneToMany(targetEntity=Sollicitatie::class, mappedBy="vacature_id", orphanRemoval=true)
     */
    private $sollicitaties;
    

    public function __construct()
    {
        $this->sollicitaties = new ArrayCollection();
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
    function setPlatform(Platform $platform)
    {
        $this->platform=$platform;
        return $this;
    }
    function getPlatform():Platform
    {
        return $this->platform;
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
     * @return Collection|Sollicitatie[]
     */
    public function getSollicitaties(): Collection
    {
        return $this->sollicitaties;
    }

    public function addSollicitaty(Sollicitatie $sollicitaty): self
    {
        if (!$this->sollicitaties->contains($sollicitaty)) {
            $this->sollicitaties[] = $sollicitaty;
            $sollicitaty->setVacatureId($this);
        }

        return $this;
    }

    public function removeSollicitaty(Sollicitatie $sollicitaty): self
    {
        if ($this->sollicitaties->removeElement($sollicitaty)) {
            // set the owning side to null (unless already changed)
            if ($sollicitaty->getVacatureId() === $this) {
                $sollicitaty->setVacatureId(null);
            }
        }

        return $this;
    }
}
