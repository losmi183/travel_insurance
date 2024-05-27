<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class FrontController extends AbstractController
{
    #[Route('/', name: 'app_index', methods:['GET'])]
    public function index(): Response
    {
        return $this->render('index.html.twig');
    }

    #[Route('/table', name: 'app_table', methods:['GET'])]
    public function table(): Response
    {
        return $this->render('table.html.twig');
    }
}
