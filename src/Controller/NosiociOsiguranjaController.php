<?php

namespace App\Controller;

use App\Entity\NosiociOsiguranja;
use Doctrine\ORM\EntityManagerInterface;
use App\Services\NosiociOsiguranjaServices;
use Symfony\Component\Serializer\Serializer;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Serializer\Encoder\XmlEncoder;
use Symfony\Component\Serializer\Encoder\JsonEncoder;
use Symfony\Component\Serializer\Normalizer\ObjectNormalizer;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NosiociOsiguranjaController extends AbstractController
{
    private NosiociOsiguranjaServices $nosiociOsiguranjaServices;

    public function __construct(NosiociOsiguranjaServices $nosiociOsiguranjaServices)
    {
        $this->nosiociOsiguranjaServices = $nosiociOsiguranjaServices;
    }

    #[Route('/nosioci', name: 'app_nosioci')]
    public function index(): Response
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $data = $this->repository->findAll();

        $jsonContent = $serializer->serialize($data, 'json');

        return new Response($jsonContent, Response::HTTP_OK, [
            'Content-Type' => 'application/json'
        ]);
        // $data = $this->repository->findAll();
        // $responseData = array_map(function($item) {
        //     return [
        //         'id' => $item->getId(),
        //         'ime_prezime' => $item->getImePrezime(),
        //         'datum_rodjenja' => $item->getDatumRodjenjaFormated(),
        //         'broj_pasosa' => $item->getBrojPasosa(),
        //         'telefon' => $item->getTelefon(),
        //         'email' => $item->getEmail(),
        //         'datum_putovanja_od' => $item->getDatumPutovanjaOdFormated(),
        //         'datum_putovanja_do' => $item->getDatumPutovanjaDoFormated(),
        //         'vrsta_polise' => $item->getVrstaPolise(),
        //         'datum_kreiranja' => $item->getDatumKreiranjaFormated(),
        //     ];
        // }, $data);
        // return $this->json($responseData);
    }

    #[Route('/app/store', name: 'app_store', methods:['POST'])]
    public function store(Request $request)
    {
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $serializer = new Serializer($normalizers, $encoders);

        $data = $serializer->deserialize($request->getContent(), NosiociOsiguranja::class, 'json');

        $result = $this->nosiociOsiguranjaServices->store($data);

        return $this->json($data);
    }
}
