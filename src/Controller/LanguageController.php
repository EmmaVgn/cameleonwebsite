<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\RedirectResponse;
use Symfony\Component\HttpFoundation\Session\SessionInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class LanguageController extends AbstractController
{
    #[Route('/change-language/{lang}', name: 'change_language')]
    public function changeLanguage(string $lang, Request $request, SessionInterface $session): RedirectResponse
    {
        // Vérifier si la langue est supportée
        $supportedLanguages = ['fr', 'en']; // Ajoute d'autres langues si besoin
        if (!in_array($lang, $supportedLanguages)) {
            $lang = 'fr'; // Langue par défaut
        }

        // Stocker la langue dans la session
        $session->set('_locale', $lang);

        // Rediriger vers la page précédente
        $referer = $request->headers->get('referer', $this->generateUrl('homepage'));
        return new RedirectResponse($referer);
    }
}
