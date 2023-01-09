<?php

namespace App\Entity;

use App\Repository\PeinePrisonRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: PeinePrisonRepository::class)]
class PeinePrison
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\ManyToOne(inversedBy: 'peinePrisons')]
    private ?Citoyen $citoyen = null;

    #[ORM\ManyToOne(inversedBy: 'peinePrisons')]
    private ?Agent $agent = null;

    #[ORM\Column(length: 255)]
    private ?string $motif = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?float $temps = null;

    #[ORM\Column]
    private ?bool $etat = null;
    
    public function __toString()
    {
        return $this->getId();
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

    public function getMotif(): ?string
    {
        return $this->motif;
    }

    public function setMotif(string $motif): self
    {
        $this->motif = $motif;

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

    public function getTemps(): ?float
    {
        return $this->temps;
    }

    public function setTemps(float $temps): self
    {
        $this->temps = $temps;

        return $this;
    }

    public function isEtat(): ?bool
    {
        return $this->etat;
    }

    public function setEtat(bool $etat): self
    {
        $this->etat = $etat;

        return $this;
    }
}
