<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Entity\Article;
use App\Entity\Contact;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
        public function index(): Response
        {
            $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
            return $this->redirect($adminUrlGenerator->setController(ContactCrudController::class)->generateUrl());
        }
        
    

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Cameleon Solutions');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Blog', 'fas fa-microblog', Article::class);
        yield MenuItem::linkToCrud('Tags', 'fas fa-tags', Tag::class);
        yield MenuItem::linkToCrud('Messages', 'fas fa-envelope', Contact::class);
        yield MenuItem::linkToRoute('Retour au site', 'fas fa-home', 'homepage');
    }
}
