<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class ProjectController extends AbstractController
{
    #[Route('/project', name: 'app_project')]
    public function list(): Response
    {
        $projects = [
            [
                'id' => 1,
                'title' => 'Projet A',
                'short_description' => 'Description courte du projet A.',
                'description' => 'Description détaillée du projet A.',
                'image' => '/images/project-a.jpg',
                'images' => [
                    '/images/project-a-1.jpg',
                    '/images/project-a-2.jpg',
                    '/images/project-a-3.jpg',
                ],
            ],
            [
                'id' => 2,
                'title' => 'Projet B',
                'short_description' => 'Description courte du projet B.',
                'description' => 'Description détaillée du projet B.',
                'image' => '/images/project-b.jpg',
                'images' => [
                    '/images/project-b-1.jpg',
                    '/images/project-b-2.jpg',
                    '/images/project-b-3.jpg',
                ],
            ],
            // Ajoute d'autres projets ici
        ];

        return $this->render('project/realisations.html.twig', [
            'projects' => $projects,
        ]);
    }
}
