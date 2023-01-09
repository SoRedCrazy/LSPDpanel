<?php

namespace App\Entity;

use App\Repository\VolRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VolRepository::class)]
class Vol
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'vols')]
    private ?Citoyen $citoyen = null;

    #[ORM\ManyToOne(inversedBy: 'vols')]
    private ?Agent $agent = null;

    #[ORM\Column(length: 255)]
    private ?string $objet = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $estimation = null;

    #[ORM\ManyToOne(inversedBy: 'vols')]
    private ?citoyen $suspect = null;

    #[ORM\Column(length: 255)]
    private ?string $notes = null;
    
    public function __toString()
    {
        return $this->getId() ;
    }
    
    


    public function getId(): ?int
    {
        return $this->id;
    }

    public function getCitoyen(): ?Citoyen
    {
        return $this->citoyen;
    }

    public function setCitoyen(?Citoyen $citoyen): self
    {
        $this->citoyen = $citoyen;

        return $this;
    }

    public function getAgent(): ?Agent
    {
        return $this->agent;
    }

    public function setAgent(?Agent $agent): self
    {
        $this->agent = $agent;

        return $this;
    }

    public function getObjet(): ?string
    {
        return $this->objet;
    }

    public function setObjet(string $objet): self
    {
        $this->objet = $objet;

        return $this;
    }

    public function getDate(): ?\DateTimeInterface
    {
        return $this->date;
    }

    public function setDate(\DateTimeInterface $date): self
    {
        $this->date = $date;

        return $this;
    }

    public function getEstimation(): ?int
    {
        return $this->estimation;
    }

    public function setEstimation(int $estimation): self
    {
        $this->estimation = $estimation;

        return $this;
    }

    public function getSuspect(): ?citoyen
    {
        return $this->suspect;
    }

    public function setSuspect(?citoyen $suspect): self
    {
        $this->suspect = $suspect;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }
}
