<?php

namespace App\Entity;

use App\Repository\AmendeRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: AmendeRepository::class)]
class Amende
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;


    #[ORM\Column(length: 255)]
    private ?string $motif = null;

    #[ORM\Column(type: Types::DATE_MUTABLE)]
    private ?\DateTimeInterface $date = null;

    #[ORM\Column]
    private ?int $montant = null;

    #[ORM\Column]
    private ?bool $payer = null;

    #[ORM\ManyToOne(inversedBy: 'amendes')]
    private ?Citoyen $citoyen = null;

    #[ORM\ManyToOne(inversedBy: 'amendes')]
    private ?Agent $Agent = null;


    public function __toString()
    {
        return $this->getId();
    }

    public function getId(): ?int
    {
        return $this->id;
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

    public function getMontant(): ?int
    {
        return $this->montant;
    }

    public function setMontant(int $montant): self
    {
        $this->montant = $montant;

        return $this;
    }

    public function ispayer(): ?bool
    {
        return $this->payer;
    }

    public function setpayer(bool $payer): self
    {
        $this->payer = $payer;

        return $this;
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
        return $this->Agent;
    }

    public function setAgent(?Agent $Agent): self
    {
        $this->Agent = $Agent;

        return $this;
    }
}
