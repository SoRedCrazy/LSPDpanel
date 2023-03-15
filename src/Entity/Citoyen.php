<?php

namespace App\Entity;

use App\Repository\CitoyenRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\HttpFoundation\File\File;
use Vich\UploaderBundle\Mapping\Annotation as Vich;



#[ORM\Entity(repositoryClass: CitoyenRepository::class)]
#[Vich\Uploadable]
class Citoyen
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;
    
    #[Vich\UploadableField(mapping: 'avatar', fileNameProperty: 'imageName', size: 'imageSize')]
    private ?File $imageFile = null;

    #[ORM\Column(type: 'string')]
    private ?string $imageName = null;

    #[ORM\Column(type: 'integer')]
    private ?int $imageSize = null;
    
    #[ORM\Column(type: 'datetime')]
    private ?\DateTimeInterface $updatedAt = null;


    #[ORM\Column(length: 255)]
    private ?string $Username = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $dateNaissance = null;

    #[ORM\Column]
    private ?int $Num_Telephone = null;

    #[ORM\Column(length: 255)]
    private ?string $sexe = null;

    #[ORM\Column]
    private ?int $taille = null;

    #[ORM\Column(length: 255)]
    private ?string $metier = null;

    #[ORM\Column]
    private ?bool $rechercher = null;

    #[ORM\OneToMany(mappedBy: 'citoyen', targetEntity: Amende::class)]
    private Collection $amendes;

    #[ORM\OneToMany(mappedBy: 'proprietaire', targetEntity: Vehicule::class)]
    private Collection $vehicules;

    #[ORM\OneToMany(mappedBy: 'citoyen', targetEntity: VolVehicule::class)]
    private Collection $volVehicules;

    #[ORM\OneToMany(mappedBy: 'citoyen', targetEntity: PeinePrison::class)]
    private Collection $peinePrisons;

    #[ORM\OneToMany(mappedBy: 'citoyen', targetEntity: Plainte::class)]
    private Collection $plaintes;

    #[ORM\OneToMany(mappedBy: 'citoyen', targetEntity: Vol::class)]
    private Collection $vols;

    #[ORM\OneToMany(mappedBy: 'citoyen', targetEntity: Armes::class)]
    private Collection $armes;

    public function __construct()
    {
        $this->amendes = new ArrayCollection();
        $this->vehicules = new ArrayCollection();
        $this->volVehicules = new ArrayCollection();
        $this->peinePrisons = new ArrayCollection();
        $this->plaintes = new ArrayCollection();
        $this->vols = new ArrayCollection();
        $this->armes = new ArrayCollection();
    }

    
    public function __toString()
    {
        return $this->getUsername();
    }

    public function setImageFile(?File $imageFile = null): void
    {
        $this->imageFile = $imageFile;

        if (null !== $imageFile) {
            // It is required that at least one field changes if you are using doctrine
            // otherwise the event listeners won't be called and the file is lost
            $this->updatedAt = new \DateTimeImmutable();
        }
    }

    public function getImageFile(): ?File
    {
        return $this->imageFile;
    }

    public function setImageName(?string $imageName): void
    {
        $this->imageName = $imageName;
    }

    public function getImageName(): ?string
    {
        return $this->imageName;
    }

    public function setImageSize(?int $imageSize): void
    {
        $this->imageSize = $imageSize;
    }

    public function getImageSize(): ?int
    {
        return $this->imageSize;
    }
    public function getId(): ?int
    {
        return $this->id;
    }

    public function getUsername(): ?string
    {
        return $this->Username;
    }

    public function setUsername(string $Username): self
    {
        $this->Username = $Username;

        return $this;
    }

    public function getDateNaissance(): ?\DateTimeInterface
    {
        return $this->dateNaissance;
    }

    public function setDateNaissance(\DateTimeInterface $dateNaissance): self
    {
        $this->dateNaissance = $dateNaissance;

        return $this;
    }

    public function getNumTelephone(): ?int
    {
        return $this->Num_Telephone;
    }

    public function setNumTelephone(int $Num_Telephone): self
    {
        $this->Num_Telephone = $Num_Telephone;

        return $this;
    }

    public function getSexe(): ?string
    {
        return $this->sexe;
    }

    public function setSexe(string $sexe): self
    {
        $this->sexe = $sexe;

        return $this;
    }

    public function getTaille(): ?int
    {
        return $this->taille;
    }

    public function setTaille(int $taille): self
    {
        $this->taille = $taille;

        return $this;
    }

    public function getMetier(): ?string
    {
        return $this->metier;
    }

    public function setMetier(string $metier): self
    {
        $this->metier = $metier;

        return $this;
    }

    public function isRechercher(): ?bool
    {
        return $this->rechercher;
    }

    public function setRechercher(bool $rechercher): self
    {
        $this->rechercher = $rechercher;

        return $this;
    }


    /**
     * @return Collection<int, Amende>
     */
    public function getAmendes(): Collection
    {
        return $this->amendes;
    }

    public function addAmende(Amende $amende): self
    {
        if (!$this->amendes->contains($amende)) {
            $this->amendes->add($amende);
            $amende->setCitoyen($this);
        }

        return $this;
    }

    public function removeAmende(Amende $amende): self
    {
        if ($this->amendes->removeElement($amende)) {
            // set the owning side to null (unless already changed)
            if ($amende->getCitoyen() === $this) {
                $amende->setCitoyen(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Vehicule>
     */
    public function getVehicules(): Collection
    {
        return $this->vehicules;
    }

    public function addVehicule(Vehicule $vehicule): self
    {
        if (!$this->vehicules->contains($vehicule)) {
            $this->vehicules->add($vehicule);
            $vehicule->setProprietaire($this);
        }

        return $this;
    }

    public function removeVehicule(Vehicule $vehicule): self
    {
        if ($this->vehicules->removeElement($vehicule)) {
            // set the owning side to null (unless already changed)
            if ($vehicule->getProprietaire() === $this) {
                $vehicule->setProprietaire(null);
            }
        }

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
            $volVehicule->setCitoyen($this);
        }

        return $this;
    }

    public function removeVolVehicule(VolVehicule $volVehicule): self
    {
        if ($this->volVehicules->removeElement($volVehicule)) {
            // set the owning side to null (unless already changed)
            if ($volVehicule->getCitoyen() === $this) {
                $volVehicule->setCitoyen(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, PeinePrison>
     */
    public function getPeinePrisons(): Collection
    {
        return $this->peinePrisons;
    }

    public function addPeinePrison(PeinePrison $peinePrison): self
    {
        if (!$this->peinePrisons->contains($peinePrison)) {
            $this->peinePrisons->add($peinePrison);
            $peinePrison->setCitoyen($this);
        }

        return $this;
    }

    public function removePeinePrison(PeinePrison $peinePrison): self
    {
        if ($this->peinePrisons->removeElement($peinePrison)) {
            // set the owning side to null (unless already changed)
            if ($peinePrison->getCitoyen() === $this) {
                $peinePrison->setCitoyen(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Plainte>
     */
    public function getPlaintes(): Collection
    {
        return $this->plaintes;
    }

    public function addPlainte(Plainte $plainte): self
    {
        if (!$this->plaintes->contains($plainte)) {
            $this->plaintes->add($plainte);
            $plainte->setCitoyen($this);
        }

        return $this;
    }

    public function removePlainte(Plainte $plainte): self
    {
        if ($this->plaintes->removeElement($plainte)) {
            // set the owning side to null (unless already changed)
            if ($plainte->getCitoyen() === $this) {
                $plainte->setCitoyen(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Vol>
     */
    public function getVols(): Collection
    {
        return $this->vols;
    }

    public function addVol(Vol $vol): self
    {
        if (!$this->vols->contains($vol)) {
            $this->vols->add($vol);
            $vol->setCitoyen($this);
        }

        return $this;
    }

    public function removeVol(Vol $vol): self
    {
        if ($this->vols->removeElement($vol)) {
            // set the owning side to null (unless already changed)
            if ($vol->getCitoyen() === $this) {
                $vol->setCitoyen(null);
            }
        }

        return $this;
    }

    /**
     * @return Collection<int, Armes>
     */
    public function getArmes(): Collection
    {
        return $this->armes;
    }

    public function addArme(Armes $arme): self
    {
        if (!$this->armes->contains($arme)) {
            $this->armes->add($arme);
            $arme->setCitoyen($this);
        }

        return $this;
    }

    public function removeArme(Armes $arme): self
    {
        if ($this->armes->removeElement($arme)) {
            // set the owning side to null (unless already changed)
            if ($arme->getCitoyen() === $this) {
                $arme->setCitoyen(null);
            }
        }

        return $this;
    }

}
