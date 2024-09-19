<?php

namespace App\Controller;

use App\Repository\ArticleRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BlogController extends AbstractController
{
    #[Route('/blog', name: 'blog_list')]
    public function list(ArticleRepository $articleRepository): Response
    {
        $articles = $articleRepository->findBy([], [], 3);
        return $this->render('blog/list.html.twig', [
            'articles' => $articles,
        ]);
    }

    #[Route('/blog/{slug}', name: 'blog_show')]
    public function show($slug, ArticleRepository $articleRepository): Response
    {
        $article = $articleRepository->find($slug);
        if (!$article) {
            throw $this->createNotFoundException('Article not found');
        }
        return $this->render('blog/show.html.twig', [
            'article' => $article,
        ]);
    }
}