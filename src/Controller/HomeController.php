<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(): Response
    {
        return $this->render('home/index.html.twig', [
            'controller_name' => 'Homepage',
        ]);
    }

    #[Route('/mentions-legales', name: 'home_legal')]
    public function legal(): Response
    {
        return $this->render('home/legal.html.twig');
    }

    #[Route('/cgv', name: 'home_cgv')]
    public function cgv(): Response
    {
        return $this->render('home/cgv.html.twig');
    }

    #[Route('/politiques-de-confidentialite', name: 'home_politique')]
    public function politique(): Response
    {
        return $this->render('home/politique.html.twig');
    }

}

