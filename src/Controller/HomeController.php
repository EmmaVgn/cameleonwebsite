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
    $project = [
        [
            'id' => 1,
            'title' => 'Garage Thomas',
            'short_description' => 'Création d\'un site vitrine pour un garage automobile.',
            'description' => 'Site vitrine pour un garage automobile. Présentation des services et des véhicules d\'occasion en vente.',
            'image' =>  '/img/project a/Image-7.png',
            'images' => [
                '/img/project a/Image-6.png',
                '/img/project a/Image-10.png',
                '/img/project a/Image-11.png',
                '/img/project a/Image-3.png',
            ],
        ],
        [
            'id' => 2,
            'title' => 'Aromelis',
            'short_description' => 'Création d\'un site e-commerce pour une apicultrice incluant la charte graphique ',
            'description' => 'Site e-commerce pour vente de miel, huiles essentielles, recharges d\hydrolats et produits de la ruche. ',
            'image' => '/img/project b/Image-13.png',
            'images' => [
                '/img/project b/Image-14.png',
                '/img/project b/Image-12.png',
                '/img/project b/Image-15.png',
                '/img/project b/Image-16.png',
                '/img/project b/Image-17.png',
            ],
        ],
        [
            'id' => 3,
            'title' => 'Application Météo',
            'short_description' => 'Création d\'une application météo.',
            'description' => 'Création d\'une application météo avec affichage des températures, des conditions météorologiques.',
            'image' => '/images/project-b.jpg',
            'images' => [
                '/images/project-b-1.jpg',
                '/images/project-b-2.jpg',
                '/images/project-b-3.jpg',
            ],
        ],
  
    ];

    return $this->render('home/index.html.twig', [
        'controller_name' => 'Homepage',
        'project' => $project,
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

