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
use Symfony\Component\Validator\Validator\ValidatorInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class NosiociOsiguranjaController extends AbstractController
{
    private NosiociOsiguranjaServices $nosiociOsiguranjaServices;
    private $serializer;

    public function __construct(NosiociOsiguranjaServices $nosiociOsiguranjaServices)
    {
        $this->nosiociOsiguranjaServices = $nosiociOsiguranjaServices;
        $encoders = [new XmlEncoder(), new JsonEncoder()];
        $normalizers = [new ObjectNormalizer()];
        $this->serializer = new Serializer($normalizers, $encoders);
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
    public function store(Request $request, ValidatorInterface $validator)
    {
        // Decode the request content
        $decodedRequest = json_decode($request->getContent(), true);

        // Extract 'dodatniOsiguranici' before deserialization
        $dodatniOsiguraniciData = $decodedRequest['dodatniOsiguranici'] ?? [];
        unset($decodedRequest['dodatniOsiguranici']);

        // Radi se duplo da bi ostalo za primer 2 načina deserializacije
        // $data = $this->serializer->deserialize($decodedRequest, NosiociOsiguranja::class, 'json');        
        $data = $this->serializer->deserialize(json_encode($decodedRequest), NosiociOsiguranja::class, 'json');

        $errors = $validator->validate($data);

        if (count($errors) > 0) {
            $errorMessages = [];
            foreach ($errors as $error) {
                $errorMessages[$error->getPropertyPath()] = $error->getMessage();
            }    
            return $this->json([
                'errors' => $errorMessages,
            ], JsonResponse::HTTP_BAD_REQUEST); // 400 status code
        }        

        $result = $this->nosiociOsiguranjaServices->store($data, $dodatniOsiguraniciData);

        return $this->json([
            'success' => true,
            'message' => 'Uspešno upisano u bazu.'
        ]);
    }
}
