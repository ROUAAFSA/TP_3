<?php

namespace App\Entity;
use App\Repository\VoitureRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;
use Doctrine\Common\Collections\Collection;

#[ORM\Entity(repositoryClass: VoitureRepository::class)]
class Voiture
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private int $id;
    #[ORM\Column(length: 50)]
    private string $serie;

    #[ORM\Column(length: 50)]
    private string $modele;

   #[ORM\Column(type: Types::DATE_MUTABLE, nullable: true)]
   private \DateTime $date_Mise_En_Marche;
    #[ORM\Column(nullable: true)]
    private float $prix_Jour;

    #[ORM\OneToMany(targetEntity: Location::class, mappedBy: 'voiture', cascade: ['persist', 'remove'])]
    private Collection $locations;

    public function getPrixJour(): float
    {
        return $this->prix_Jour;
    }

    public function getLocations(): Collection
    {
        return $this->locations;
    }

    public function setLocations(Collection $locations): void
    {
        $this->locations = $locations;
    }

    public function setPrixJour(float $prix_Jour): void
    {
        $this->prix_Jour = $prix_Jour;
    }

    public function getSerie(): string
    {
        return $this->serie;
    }

    public function getDateMiseEnMarche(): \DateTime
    {
        return $this->date_Mise_En_Marche;
    }

    public function setDateMiseEnMarche(\DateTime $date_Mise_En_Marche): void
    {
        $this->date_Mise_En_Marche = $date_Mise_En_Marche;
    }

    public function getModele(): string
    {
        return $this->modele;
    }

    public function setModele(string $modele): void
    {
        $this->modele = $modele;
    }

    public function setSerie(string $serie): void
    {
        $this->serie = $serie;
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): void
    {
        $this->id = $id;
    }





}
