<?php

namespace App\Services;

use App\Entity\DodatnaLica;
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
    public function store(NosiociOsiguranja $data, array $dodatniOsiguraniciData)
    {
        $this->em->persist($data);  
        $this->em->flush();

        if (count($dodatniOsiguraniciData) > 0) {
            foreach ($dodatniOsiguraniciData as $liceData) {
                $lice = new DodatnaLica();
                $lice->setImePrezime($liceData['ime_prezime']);
                $lice->setDatumRodjenja(new \DateTime($liceData['datum_rodjenja']));
                $lice->setBrojPasosa($liceData['broj_pasosa']);
                // Ako postoji relacija između NosiociOsiguranja i DodatnaLica, postavi je ovde
                $lice->setNosilacOsiguranjaId($data); 

                $this->em->persist($lice);
            }
            $this->em->flush();
        }

        return $data;
    }
}