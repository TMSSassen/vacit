<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

/**
 * @ORM\Entity(repositoryClass=UserRepository::class)
 */
class User implements UserInterface {

    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $voornaam;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $achternaam;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $password;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $salt="";

    /**
     * @ORM\Column(name="is_active", type="boolean")
     */
    private $isActive=0;

    /**
     * @ORM\Column(type="json")
     */
    private $roles = [];

    /**
     * @ORM\Column(type="datetime")
     */
    private $geboortedatum;

    /**
     * @ORM\Column(type="string", length=15)
     */
    private $telefoonnummer;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $adres;

    /**
     * @ORM\Column(type="string", length=8)
     */
    private $postcode;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $email;

    /**
     * @ORM\Column(type="string", length=50)
     */
    private $woonplaats;

    /**
     * @ORM\Column(type="text")
     */
    private $beschrijving="";

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $foto_url;

    /**
     * @ORM\Column(type="string", length=50, nullable=true)
     */
    private $cv_url;

    /**
     * @ORM\OneToMany(targetEntity=Vacature::class, mappedBy="bedrijf_id", orphanRemoval=true)
     */
    private $vacatures;

    /**
     * @ORM\OneToMany(targetEntity=Sollicitatie::class, mappedBy="user_id", orphanRemoval=true)
     */
    private $sollicitaties;

    public function __construct() {
        $this->vacatures = new ArrayCollection();
        $this->sollicitaties = new ArrayCollection();
    }

    public function getId(): ?int {
        return $this->id;
    }

    public function getVoornaam(): ?string {
        return $this->voornaam;
    }

    public function setVoornaam(string $voornaam): self {
        $this->voornaam = $voornaam;

        return $this;
    }

    public function getAchternaam(): ?string {
        return $this->achternaam;
    }

    public function setAchternaam(string $achternaam): self {
        $this->achternaam = $achternaam;

        return $this;
    }

    public function getGeboortedatum(): ?\DateTimeInterface {
        return $this->geboortedatum;
    }

    public function setGeboortedatum(\DateTimeInterface $geboortedatum): self {
        $this->geboortedatum = $geboortedatum;

        return $this;
    }

    public function getTelefoonnummer(): ?string {
        return $this->telefoonnummer;
    }

    public function setTelefoonnummer(string $telefoonnummer): self {
        $this->telefoonnummer = $telefoonnummer;

        return $this;
    }

    public function getAdres(): ?string {
        return $this->adres;
    }

    public function setAdres(string $adres): self {
        $this->adres = $adres;

        return $this;
    }

    public function getPostcode(): ?string {
        return $this->postcode;
    }

    public function setPostcode(string $postcode): self {
        $this->postcode = $postcode;

        return $this;
    }

    public function getEmail(): ?string {
        return $this->email;
    }

    public function setEmail(string $email): self {
        $this->email = $email;

        return $this;
    }

    public function getWoonplaats(): ?string {
        return $this->woonplaats;
    }

    public function setWoonplaats(string $woonplaats): self {
        $this->woonplaats = $woonplaats;

        return $this;
    }

    public function getBeschrijving(): ?string {
        return $this->beschrijving;
    }

    public function setBeschrijving(string $beschrijving): self {
        $this->beschrijving = $beschrijving;

        return $this;
    }

    public function getFotoUrl(): ?string {
        return $this->foto_url;
    }

    public function setFotoUrl(?string $foto_url): self {
        $this->foto_url = $foto_url;

        return $this;
    }

    public function getCvUrl(): ?string {
        return $this->cv_url;
    }

    public function setCvUrl(?string $cv_url): self {
        $this->cv_url = $cv_url;

        return $this;
    }
    
    function addRol(string $rol):self
    {
        $this->roles[]=$rol;
        return $this;
    }

    public function getRol(): ?string {
        return $this->rol;
    }

    public function setRol(string $rol): self {
        $this->rol = $rol;

        return $this;
    }

    /**
     * @return Collection|Vacature[]
     */
    public function getVacatures(): Collection {
        return $this->vacatures;
    }

    public function addVacature(Vacature $vacature): self {
        if (!$this->vacatures->contains($vacature)) {
            $this->vacatures[] = $vacature;
            $vacature->setBedrijfId($this);
        }

        return $this;
    }

    public function removeVacature(Vacature $vacature): self {
        if ($this->vacatures->removeElement($vacature)) {
            // set the owning side to null (unless already changed)
            if ($vacature->getBedrijfId() === $this) {
                $vacature->setBedrijfId(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection|Sollicitatie[]
     */
    public function getSollicitaties(): Collection {
        return $this->sollicitaties;
    }

    public function addSollicitaty(Sollicitatie $sollicitaty): self {
        if (!$this->sollicitaties->contains($sollicitaty)) {
            $this->sollicitaties[] = $sollicitaty;
            $sollicitaty->setUserId($this);
        }

        return $this;
    }

    public function removeSollicitaty(Sollicitatie $sollicitaty): self {
        if ($this->sollicitaties->removeElement($sollicitaty)) {
            // set the owning side to null (unless already changed)
            if ($sollicitaty->getUserId() === $this) {
                $sollicitaty->setUserId(null);
            }
        }

        return $this;
    }

    public function eraseCredentials() {
        
    }

    public function getPassword() {
        return $this->password;
    }

    public function setPassword($password) {
        $this->password = $password;
    }

    public function getSalt() {
        return $this->salt;
    }

    public function setSalt($salt) {
        $this->salt = $salt;
    }

    public function getIsActive() {
        return $this->isActive;
    }

    public function setIsActive($isActive) {
        $this->isActive = $isActive;
    }

    public function getUsername(): string {
        return $this->email;
    }

    public function getRoles(): array {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }
    
    public function setRoles($roles)
    {
        $this->roles=$roles;
    }
    
    public function setBedrijfsnaam($string): User
    {
        $this->voornaam="";
        $this->achternaam=$string;
    }
    
    public function getBedrijfsnaam()
    {
        return $this->achternaam;
    }

}
