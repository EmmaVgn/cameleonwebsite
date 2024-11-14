<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class LegalController extends AbstractController
{
    #[Route('/all-mentions', name: 'legal_all')]
    public function all(): Response
    {
        return $this->render('legals/index.html.twig');
    }

    #[Route('/mentions-legales', name: 'mentions_legales')]
    public function mentionsLegales(): Response
    {
        return $this->render('legal/mentions_legales.html.twig');
    }

    #[Route('/politique-de-confidentialite', name: 'politique_confidentialite')]
    public function politiqueConfidentialite(): Response
    {
        return $this->render('legal/politique_confidentialite.html.twig');
    }

    #[Route('/cgv', name: 'cgv')]
    public function cgv(): Response
    {
        return $this->render('legal/cgv.html.twig');
    }

    #[Route('/politique-de-remboursement', name: 'politique_remboursement')]
    public function politiqueRemboursement(): Response
    {
        return $this->render('legal/politique_remboursement.html.twig');
    }

    #[Route('/politique-de-cookies', name: 'politique_cookies')]
    public function politiqueCookies(): Response
    {
        return $this->render('legal/politique_cookies.html.twig');
    }

    #[Route('/plan-du-site', name: 'plan_du_site')]
    public function planDuSite(): Response
    {
        return $this->render('legal/map_site.html.twig');
    }

    #[Route('/donnees-personnelles', name: 'donnees_personnelles')]
    public function donneesPersonnelles(): Response
    {
        return $this->render('legal/donnees_personnelles.html.twig');
    }

    #[Route('/cgu', name: 'cgu')]
    public function cgu(): Response
    {
        return $this->render('legal/cgu.html.twig');
    }


}
