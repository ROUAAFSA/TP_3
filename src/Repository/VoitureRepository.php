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
}
