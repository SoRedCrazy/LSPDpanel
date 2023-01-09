<?php

namespace App\Entity;

use App\Repository\VolVehiculeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: VolVehiculeRepository::class)]
class VolVehicule
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'volVehicules')]
    private ?Citoyen $citoyen = null;

    #[ORM\ManyToOne(inversedBy: 'volVehicules')]
    private ?Agent $agent = null;

    #[ORM\ManyToOne(inversedBy: 'volVehicules')]
    private ?Vehicule $vehicule = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column(length: 255)]
    private ?string $suspect = null;

    #[ORM\Column(length: 255, nullable: true)]
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

    public function getVehicule(): ?Vehicule
    {
        return $this->vehicule;
    }

    public function setVehicule(?Vehicule $vehicule): self
    {
        $this->vehicule = $vehicule;

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

    public function getSuspect(): ?string
    {
        return $this->suspect;
    }

    public function setSuspect(string $suspect): self
    {
        $this->suspect = $suspect;

        return $this;
    }

    public function getNotes(): ?string
    {
        return $this->notes;
    }

    public function setNotes(?string $notes): self
    {
        $this->notes = $notes;

        return $this;
    }
}
