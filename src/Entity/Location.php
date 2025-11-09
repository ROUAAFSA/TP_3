<?php

namespace App\Entity;

use App\Repository\LocationRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: LocationRepository::class)]
class Location
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateDebut = null;

    #[ORM\ManyToOne(targetEntity: Voiture::class, inversedBy: 'locations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Voiture $voiture = null;

    #[ORM\ManyToOne(targetEntity: Client::class, inversedBy: 'locations')]
    #[ORM\JoinColumn(nullable: false)]
    private ?Client $client = null;

    public function getVoiture(): ?Voiture
    {
        return $this->voiture;
    }

    public function setVoiture(?Voiture $voiture): void
    {
        $this->voiture = $voiture;
    }

    #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
    private ?\DateTime $dateRetour = null;

    #[ORM\Column(nullable: true)]
    private ?float $prix = null;

    public function getClient(): ?Client
    {
        return $this->client;
    }

    public function setClient(?Client $client): void
    {
        $this->client = $client;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getDateDebut(): ?\DateTime
    {
        return $this->dateDebut;
    }

    public function setDateDebut(?\DateTime $dateDebut): static
    {
        $this->dateDebut = $dateDebut;

        return $this;
    }

    public function getDateRetour(): ?\DateTime
    {
        return $this->dateRetour;
    }

    public function setDateRetour(?\DateTime $dateRetour): static
    {
        $this->dateRetour = $dateRetour;

        return $this;
    }

    public function getPrix(): ?float
    {
        return $this->prix;
    }

    public function setPrix(?float $prix): static
    {
        $this->prix = $prix;

        return $this;
    }
}
