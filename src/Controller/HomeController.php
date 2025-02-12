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
    #[Route('/test', name: 'test')]
    public function test(): Response
    {
       

        return $this->render('home/test.html.twig', [
            'controller_name' => 'Homepage',
   
        ]);
    }

    private function getProjects(): array 
{
    return [
        [
            'id' => 1,
            'title' => 'Garage Thomas',
            'short_description' => 'Création d\'un site vitrine pour un garage automobile.',
            'link' => 'https://garagethomas.cameleon-solutions.fr/', // Lien vers le site
            'image' =>  '/img/project a/Image-6-min.webp',
        ],
        [
            'id' => 2,
            'title' => 'Aromelis',
            'short_description' => 'Site e-commerce pour une apicultrice.',
            'link' => 'https://mariefarjaud.fr/', // Lien vers le site
            'image' => '/img/project b/Image-2-min.webp',
        ],
        [
            'id' => 3,
            'title' => 'Application Météo',
            'short_description' => 'Application météo interactive.',
              'link' => '#',
            'image' => '/img/project c/Image-18-min.webp',
        ],
        [
            'id' => 4,
            'title' => 'Les maisons de Marie',
            'short_description' => 'Site de réservation pour un établissement touristique.',
            'link' => 'https://lesmaisonsdemarie.cameleon-solutions.fr/', // Lien vers le site
            'image' => '/img/project d/Image-20.webp',
            
        ],
    ];
}



}
