<?php

namespace App\Controller;

use App\Entity\NosiociOsiguranja;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Attribute\Route;
use App\Repository\NosiociOsiguranjaRepository;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NosiociOsiguranjaController extends AbstractController
{
    private $em;
    private $repository;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
        $this->repository = $this->em->getRepository(NosiociOsiguranja::class);
    }

    #[Route('/', name: 'app_home')]
    public function index(): JsonResponse
    {
        $data = $this->repository->findAll();

        $responseData = array_map(function($item) {
            return [
                'id' => $item->getId(),
                'ime_prezime' => $item->getImePrezime(),
                'datum_rodjenja' => $item->getDatumRodjenjaFormated(),
                'broj_pasosa' => $item->getBrojPasosa(),
                'telefon' => $item->getTelefon(),
                'email' => $item->getEmail(),
                'datum_putovanja_od' => $item->getDatumPutovanjaOdFormated(),
                'datum_putovanja_do' => $item->getDatumPutovanjaDoFormated(),
                'vrsta_polise' => $item->getVrstaPolise(),
                'datum_kreiranja' => $item->getDatumKreiranjaFormated(),
            ];
        }, $data);

        return $this->json($responseData);
    }

    #[Route('/table', name: 'app_table')]
    public function table(): JsonResponse
    {
        return $this->json([
            'data' => 'tabela'
        ]);
    }
}
