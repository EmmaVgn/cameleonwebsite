<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Cookie;

class CookieConsentController extends AbstractController
{
    #[Route('/set-cookie-consent', name: 'set_cookie_consent')]
    public function setCookieConsent(): Response
    {
        // Créer un cookie pour mémoriser le consentement de l'utilisateur
        $cookie = new Cookie('cookie_consent', 'true', time() + 3600 * 24 * 365, '/', null, true, true, false, 'Strict');
        
        // Créer une réponse pour confirmer le consentement
        $response = new Response('Cookie consent has been accepted.');
        
        // Ajouter le cookie à la réponse
        $response->headers->setCookie($cookie);
        
        // Retourner la réponse
        return $response;
    }
    
    #[Route('/check-cookie-consent', name: 'check_cookie_consent')]
    public function checkCookieConsent(): Response
    {
        // Vérifier si l'utilisateur a déjà consenti aux cookies
        $cookieConsent = $this->container->get('request_stack')->getCurrentRequest()->cookies->get('cookie_consent');
        
        if ($cookieConsent === 'true') {
            // L'utilisateur a consenti aux cookies
            return new Response('User has consented to cookies.');
        } else {
            // L'utilisateur n'a pas consenti aux cookies
            return new Response('User has not consented to cookies.');
        }
    }
}
