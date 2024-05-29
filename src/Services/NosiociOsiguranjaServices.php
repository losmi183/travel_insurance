<?php

namespace App\Services;

use App\Entity\DodatnaLica;
use Doctrine\DBAL\Connection;
use App\Entity\NosiociOsiguranja;
use Doctrine\ORM\EntityManagerInterface;

class NosiociOsiguranjaServices
{
    private EntityManagerInterface $em;
    private $repository;
    private Connection $connection;
    public function __construct(EntityManagerInterface $em, Connection $connection)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository(NosiociOsiguranja::class);
        $this->connection = $connection;
    }

    public function paginate(int $start, int $length): array
    {
        $count = $this->connection->fetchAllAssociative("
            SELECT COUNT(*) AS total FROM nosioci_osiguranja
        ");

        $query = "
            SELECT
                n.id,
                DATE_FORMAT(n.datum_kreiranja, '%d-%m-%Y') AS datum_kreiranja,
                n.ime_prezime, 
                DATE_FORMAT(n.datum_rodjenja, '%d-%m-%Y') AS datum_rodjenja,
                n.broj_pasosa,
                n.telefon,
                n.email,
                DATE_FORMAT(n.datum_putovanja_od, '%d-%m-%Y') AS datum_putovanja_od,
                DATE_FORMAT(n.datum_putovanja_do, '%d-%m-%Y') AS datum_putovanja_do,
                DATEDIFF(n.datum_putovanja_do, n.datum_putovanja_od) AS broj_dana,
                n.vrsta_polise,
                GROUP_CONCAT(CONCAT(
                    'Ime i prezime: ', d.ime_prezime, ', datum rodjenja: ', DATE_FORMAT(d.datum_rodjenja, '%d-%m-%Y'), ', br pasosa: ', d.broj_pasosa) SEPARATOR '\n') AS dodatna_lica 
            FROM nosioci_osiguranja AS n
            LEFT JOIN dodatna_lica AS d ON n.id = d.nosilac_osiguranja_id
            GROUP BY n.id
            LIMIT $length 
            OFFSET $start
        ";
        $result = $this->connection->fetchAllAssociative($query);

        return [
            "recordsTotal" => intval($count),
            "recordsFiltered" => intval($count),
            'data' => $result
        ];
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