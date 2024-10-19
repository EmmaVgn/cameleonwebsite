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

        // Récupérer les articles les plus populaires
        $popularArticles = $articleRepository->findMostPopularArticles(5); // Limiter à 5 articles

        return $this->render('blog/display.html.twig', [
            'articles' => $articles,
            'tags' => $tags,
            'popularArticles' => $popularArticles, // Passez les articles populaires à la vue
        ]);
    }


    #[Route('/blog/search', name: 'blog_search')]
    public function search(
        ArticleRepository $articleRepository,
        TagRepository $tagRepository,
        Request $request,
        PaginatorInterface $paginator // Ajoutez ce paramètre
    ): Response {
        $searchQuery = $request->query->get('q');
        
        // Effectuer la recherche des articles (cela devrait retourner un QueryBuilder)
        $articlesQuery = $articleRepository->searchQueryBuilder($searchQuery);
        
        // Utiliser le paginator pour paginer les résultats
        $articles = $paginator->paginate(
            $articlesQuery, // la requête pour les articles
            $request->query->getInt('page', 1), // numéro de la page
            10 // nombre d'articles par page
        );
        
        // Récupérer tous les tags pour les passer à la vue
        $tags = $tagRepository->findAll();
    
        // Récupérer les articles les plus populaires
        $popularArticles = $articleRepository->findMostPopularArticles(5); // Limiter à 5 articles
    
        return $this->render('blog/search.html.twig', [
            'articles' => $articles, // articles est maintenant un objet de pagination
            'tags' => $tags,
            'popularArticles' => $popularArticles,
            'query' => $searchQuery,
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
    public function show(string $slug, ArticleRepository $articleRepository, TagRepository $tagRepository): Response
    {
        // Récupère tous les tags
        $tags = $tagRepository->findAll();
    
        // Récupérer les articles les plus populaires
        $popularArticles = $articleRepository->findMostPopularArticles(5); // Limiter à 5 articles
    
        $article = $articleRepository->findOneBy(['slug' => $slug]);
        if (!$article) {
            throw $this->createNotFoundException('Article non trouvé');
        }
    
        return $this->render('blog/show.html.twig', [
            'article' => $article,
            'tags' => $tags,
            'popularArticles' => $popularArticles, // Assurez-vous que c'est passé correctement
        ]);
    }
    
}
