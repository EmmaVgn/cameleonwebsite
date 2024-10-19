<?php

namespace App\Controller;

use App\Entity\Tag;
use App\Repository\TagRepository;
use App\Repository\ArticleRepository;
use Knp\Component\Pager\PaginatorInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog_display')]
    public function display(ArticleRepository $articleRepository, PaginatorInterface $paginator, Request $request, TagRepository $tagRepository): Response
    {
        $queryBuilder = $articleRepository->findBy([], ['createdAt' => 'DESC']); // Obtenir les articles dans l'ordre décroissant de date
     

        $articles = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1), // Page actuelle
            4 // Nombre d'articles par page
        );

        // Récupère tous les tags
        $tags = $tagRepository->findAll();

        return $this->render('blog/display.html.twig', [
            'articles' => $articles,
            'tags' => $tags, // Passe les tags à la vue
        ]);
    }

    #[Route('/blog/search', name: 'blog_search')]
    public function search(Request $request, ArticleRepository $articleRepository, PaginatorInterface $paginator): Response
    {
        $query = $request->query->get('q');
        $queryBuilder = $articleRepository->searchByQuery($query);

        $articles = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            9 // Nombre d'articles par page
        );

        return $this->render('blog/display.html.twig', [
            'articles' => $articles,
            'query' => $query,
        ]);
    }

    #[Route('/blog/tag/{slug}', name: 'blog_by_tag')]
    public function filterByTag(string $slug, TagRepository $tagRepository, ArticleRepository $articleRepository, PaginatorInterface $paginator, Request $request): Response
    {
        // Récupère le tag à partir du slug
        $tag = $tagRepository->findOneBy(['slug' => $slug]);
        if (!$tag) {
            throw $this->createNotFoundException('Tag non trouvé');
        }
    
        $queryBuilder = $articleRepository->findByTag($tag);
    
        $articles = $paginator->paginate(
            $queryBuilder,
            $request->query->getInt('page', 1),
            9 // Nombre d'articles par page
        );
    
        // Récupère tous les tags pour le filtre
        $tags = $tagRepository->findAll();
    
        return $this->render('blog/display.html.twig', [
            'articles' => $articles,
            'tags' => $tags, // Passez également les tags ici
            'tag' => $tag,
        ]);
    }
    
    

    #[Route('/blog/{slug}', name: 'blog_show')]
    public function show(string $slug, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->findOneBy(['slug' => $slug]);
        if (!$article) {
            throw $this->createNotFoundException('Article non trouvé');
        }

        return $this->render('blog/show.html.twig', [
            'article' => $article,
        ]);
    }
}
