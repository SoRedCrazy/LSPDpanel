<?php

namespace App\Entity;

use App\Repository\VehiculeRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VehiculeRepository::class)]
class Vehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 12)]
    private ?string $immatriculation = null;

    #[ORM\Column(length: 20)]
    private ?string $modele = null;

    #[ORM\Column(length: 20)]
    private ?string $couleur = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $Atcreate = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTimeInterface $dateModif = null;

    #[ORM\ManyToOne(inversedBy: 'vehicules')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Citoyen $proprietaire = null;

    #[ORM\ManyToOne(inversedBy: 'vehicules')]
    private ?Agent $agent = null;

    #[ORM\OneToMany(mappedBy: 'vehicule', targetEntity: VolVehicule::class)]
    private Collection $volVehicules;

    public function __construct() {
        $this->Atcreate = new \DateTime('now');
        $this->volVehicules = new ArrayCollection();
    }
    public function __toString()
    {
        return $this->getImmatriculation() . " ". $this->getModele() ." ". $this->getCouleur() ;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getImmatriculation(): ?string
    {
        return $this->immatriculation;
        
    }

    public function setImmatriculation(string $immatriculation): self
    {
        $this->immatriculation = $immatriculation;
        $this->dateModif = new \DateTime('now');

        return $this;
    }

    public function getModele(): ?string
    {
        return $this->modele;
    }

    public function setModele(string $modele): self
    {
        $this->modele = $modele;
        $this->dateModif = new \DateTime('now');

        return $this;
    }

    public function getCouleur(): ?string
    {
        return $this->couleur;
    }

    public function setCouleur(string $couleur): self
    {
        $this->couleur = $couleur;
        $this->dateModif = new \DateTime('now');

        return $this;
    }

    public function getAtcreate(): ?\DateTimeInterface
    {
        return $this->Atcreate;
    }

    public function setAtcreate(\DateTimeInterface $Atcreate): self
    {
        $this->Atcreate = $Atcreate;

        return $this;
    }

    public function getDateModif(): ?\DateTimeInterface
    {
        return $this->dateModif;
    }

    public function setDateModif(?\DateTimeInterface $dateModif): self
    {
        $this->dateModif = $dateModif;

        return $this;
    }

    public function getProprietaire(): ?Citoyen
    {
        return $this->proprietaire;
    }

    public function setProprietaire(?Citoyen $proprietaire): self
    {
        $this->proprietaire = $proprietaire;
        $this->dateModif = new \DateTime('now');

        return $this;
    }

    public function getAgent(): ?Agent
    {
        return $this->agent;
    }

    public function setAgent(?Agent $agent): self
    {
        $this->agent = $agent;
        $this->dateModif = new \DateTime('now');

        return $this;
    }

    /**
     * @return Collection<int, VolVehicule>
     */
    public function getVolVehicules(): Collection
    {
        return $this->volVehicules;
    }

    public function addVolVehicule(VolVehicule $volVehicule): self
    {
        if (!$this->volVehicules->contains($volVehicule)) {
            $this->volVehicules->add($volVehicule);
            $volVehicule->setVehicule($this);
        }

        return $this;
    }

    public function removeVolVehicule(VolVehicule $volVehicule): self
    {
        if ($this->volVehicules->removeElement($volVehicule)) {
            // set the owning side to null (unless already changed)
            if ($volVehicule->getVehicule() === $this) {
                $volVehicule->setVehicule(null);
            }
        }

        return $this;
    }
}
