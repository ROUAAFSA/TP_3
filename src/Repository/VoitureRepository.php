<?php

namespace App\Repository;

use App\Entity\Voiture;
use Doctrine;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
//use Symfony\Bridge\Doctrine\ManagerRegistry;

use Doctrine\Persistence\ManagerRegistry;

class VoitureRepository extends ServiceEntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Voiture::class);
    }
    public function findByModele(int $modeleId): array
    {
        $em = $this->getEntityManager();
        $query = $em->createQuery(
            "SELECT v,m
            FROM App\Entity\Voiture v
            JOIN v.modele m
            WHERE m.id = :modeleId
            ORDER BY v.serie ASC"
        )
            ->setParameter('modeleId', $modeleId);
        return $query->getResult();

    }
}
