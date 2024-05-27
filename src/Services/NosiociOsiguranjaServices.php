<?php

namespace App\Services;

use App\Entity\NosiociOsiguranja;
use Doctrine\ORM\EntityManagerInterface;

class NosiociOsiguranjaServices
{
    private $em;
    private $repository;
    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository(NosiociOsiguranja::class);
    }
    public function store(NosiociOsiguranja $data)
    {
        $this->em->persist($data);  
        $this->em->flush();
        return $data;
    }

}