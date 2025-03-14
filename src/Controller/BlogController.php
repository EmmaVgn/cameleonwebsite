<?php

namespace App\Controller;

use App\Entity\Article;
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
        $locale = $request->getLocale(); // Récupérer la langue courante

        // Récupérer les articles et leurs traductions selon la langue
        $articlesQuery = $articleRepository->findAllWithTranslations($locale);

        $articles = $paginator->paginate(
            $articlesQuery,
            $request->query->getInt('page', 1),
            4
        );

        // Récupérer les tags traduits
        $tags = $tagRepository->findAllWithTranslations($locale);

        // Récupérer les articles populaires
        $popularArticles = $articleRepository->findMostPopularArticles(5);

        return $this->render('blog/display.html.twig', [
            'articles' => $articles,
            'tags' => $tags,
            'popularArticles' => $popularArticles,
        ]);
    }

    #[Route('/blog/search', name: 'blog_search')]
    public function search(ArticleRepository $articleRepository, TagRepository $tagRepository, Request $request, PaginatorInterface $paginator): Response
    {
        $locale = $request->getLocale();
        $searchQuery = $request->query->get('q');

        $articlesQuery = $articleRepository->searchQueryBuilder($searchQuery, $locale);

        $articles = $paginator->paginate(
            $articlesQuery,
            $request->query->getInt('page', 1),
            10
        );

        $tags = $tagRepository->findAllWithTranslations($locale);
        $popularArticles = $articleRepository->findMostPopularArticles(5);

        return $this->render('blog/search.html.twig', [
            'articles' => $articles,
            'tags' => $tags,
            'popularArticles' => $popularArticles,
            'query' => $searchQuery,
        ]);
    }

    #[Route('/blog/tag/{slug}', name: 'blog_by_tag')]
    public function filterByTag(string $slug, TagRepository $tagRepository, ArticleRepository $articleRepository, PaginatorInterface $paginator, Request $request): Response
    {
        $locale = $request->getLocale();
        
        $tag = $tagRepository->findOneBySlugWithTranslation($slug, $locale);
        if (!$tag) {
            throw $this->createNotFoundException(sprintf('Tag non trouvé pour le slug "%s"', $slug));
        }

        $articlesQuery = $articleRepository->findByTagWithTranslations($tag, $locale);

        $articles = $paginator->paginate(
            $articlesQuery,
            $request->query->getInt('page', 1),
            9
        );

        $tags = $tagRepository->findAllWithTranslations($locale);
        $popularArticles = $articleRepository->findMostPopularArticles(5);

        return $this->render('blog/display.html.twig', [
            'articles' => $articles,
            'tags' => $tags,
            'tag' => $tag,
            'popularArticles' => $popularArticles,
        ]);
    }

    #[Route('/blog/{slug}', name: 'blog_show')]
    public function show(string $slug, ArticleRepository $articleRepository, TagRepository $tagRepository, Request $request): Response
    {
        $locale = $request->getLocale(); // Récupère la langue actuelle
    
        $article = $articleRepository->findArticleWithTranslation($slug, $locale);
        if (!$article) {
            throw $this->createNotFoundException('Article non trouvé');
        }
    
        $tags = $tagRepository->findAllWithColors();
        $popularArticles = $articleRepository->findMostPopularArticles(5);
    
        return $this->render('blog/show.html.twig', [
            'article' => $article,
            'tags' => $tags,
            'popularArticles' => $popularArticles,
        ]);
    }
    
}
