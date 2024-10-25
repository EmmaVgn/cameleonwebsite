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
        $projects = $this->getProjects();

        return $this->render('home/index.html.twig', [
            'controller_name' => 'Homepage',
            'projects' => $projects, // Corrigé de 'project' à 'projects'
        ]);
    }

    private function getProjects(): array 
    {
        return [
            [ 
                'id' => 1,
                'title' => 'Garage Thomas',
                'short_description' => 'Création d\'un site vitrine pour un garage automobile.',
                'description' => 'Réalisation d\'un site vitrine pour un garage automobile dans le cadre d\'un projet étudiant. Présentation des services et des véhicules d\'occasion en vente.',
                'image' =>  '/img/project a/Image-6.png',
                'images' => [
                    '/img/project a/Image.png',
                    '/img/project a/Image-10.png',
                    '/img/project a/Image-11.png',
                    '/img/project a/Image-3.png',
                ],
            ],
            [
                'id' => 2,
                'title' => 'Aromelis',
                'short_description' => 'Création d\'un site e-commerce pour une apicultrice incluant la charte graphique',
                'description' => 'Site e-commerce pour vente de miel, huiles essentielles, recharges d\'hydrolats et produits de la ruche.',
                'image' => '/img/project b/Image-13.png',
                'images' => [
                    '/img/project b/Image-17.png',
                    '/img/project b/Image-15.png',
                    '/img/project b/Image-16.png',
                    '/img/project b/Image-14.png',
                    '/img/project b/Image-12.png',
                ],
            ],
            [
                'id' => 3,
                'title' => 'Application Météo',
                'short_description' => 'Création d\'une application météo.',
                'description' => 'Création d\'une application météo avec affichage des températures, des conditions météorologiques.',
                'image' => '/img/project c/Image-18.png',
                'images' => [
                    '/img/project c/Image-19.png',
                ],
            ],
            [
                'id' => 4,
                'title' => 'Les maisons de Marie',
                'short_description' => 'Création d\'un site pour un établissement touristique',
                'description' => 'Création d\'un site pour un établissement touristique. Présentation des chambres avec possibilité de réservation sur le site, des activités et des tarifs.',
                'image' => '/img/project d/Image-20.png',
                'images' => [
                    '/img/project d/Image-22.png',
                    '/img/project d/Image-21.png',
                ],
            ],
        ];
    }

    #[Route('/mentions-legales', name: 'home_legal')]
    public function legal(): Response
    {
        return $this->render('_partials/_legal.html.twig');
    }

}
