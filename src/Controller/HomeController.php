<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Contracts\Translation\TranslatorInterface;

class HomeController extends AbstractController
{
    #[Route('/', name: 'homepage')]
    public function index(TranslatorInterface $translator): Response
    {
        $projects = $this->getProjects($translator);

        return $this->render('home/index.html.twig', [
            'controller_name' => 'Homepage',
            'projects' => $projects,
        ]);
    }

    #[Route('/test', name: 'test')]
    public function test(): Response
    {
        return $this->render('home/test.html.twig', [
            'controller_name' => 'Homepage',
        ]);
    }

    private function getProjects(TranslatorInterface $translator): array 
    {
        return [
            [
                'id' => 1,
                'title' => $translator->trans('projects.garage_thomas.title'),
                'short_description' => $translator->trans('projects.garage_thomas.description'),
                'link' => 'https://garagethomas.cameleon-solutions.fr/',
                'image' => '/img/project a/Image-6-min.webp',
            ],
            [
                'id' => 2,
                'title' => $translator->trans('projects.aromelis.title'),
                'short_description' => $translator->trans('projects.aromelis.description'),
                'link' => 'https://mariefarjaud.fr/',
                'image' => '/img/project b/Image-2-min.webp',
            ],
            [
                'id' => 3,
                'title' => $translator->trans('projects.weather_app.title'),
                'short_description' => $translator->trans('projects.weather_app.description'),
                'link' => '#',
                'image' => '/img/project c/Image-18-min.webp',
            ],
            [
                'id' => 4,
                'title' => $translator->trans('projects.maisons_marie.title'),
                'short_description' => $translator->trans('projects.maisons_marie.description'),
                'link' => 'https://lesmaisonsdemarie.net/',
                'image' => '/img/project d/Image-5.png',
            ],
        ];
    }
}
