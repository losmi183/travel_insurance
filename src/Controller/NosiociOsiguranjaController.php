<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\Routing\Attribute\Route;

class NosiociOsiguranjaController extends AbstractController
{
    #[Route('/', name: 'app_home')]
    public function index(): JsonResponse
    {
        return $this->json([
            'message' => 'Welcome to your new controller!',
            'path' => 'src/Controller/NosiociOsiguranjaController.php',
        ]);
    }

    #[Route('/table', name: 'app_table')]
    public function table(): JsonResponse
    {
        return $this->json([
            'data' => 'tabela'
        ]);
    }
}
