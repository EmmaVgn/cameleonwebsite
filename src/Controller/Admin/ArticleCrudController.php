<?php

namespace App\Controller\Admin;

use App\Entity\Article;
use Doctrine\ORM\EntityManagerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\SlugField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use Symfony\Component\String\Slugger\SluggerInterface;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;

class ArticleCrudController extends AbstractCrudController
{

    private SluggerInterface $slugger;
    
    public function __construct(SluggerInterface $slugger)
    {
        $this->slugger = $slugger;
    }
    
    public static function getEntityFqcn(): string
    {
        return Article::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Blog')
            ->setEntityLabelInPlural('Blogs')
            ->setDefaultSort(['id' => 'DESC'])
        ;
    }
    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Titre'),
            TextareaField::new('subtitle', 'Sous-titre'),
            TextareaField::new('content', 'Contenu'),
            AssociationField::new('tags', 'Tags')
            ->setFormTypeOptions([
                'by_reference' => false, // Important pour les relations ManyToMany
            ]),        
            SlugField::new('slug')
                ->setTargetFieldName('name'), // Spécifie le champ utilisé pour générer le slug
                ImageField::new('imageName')
                ->setBasePath('img/blog/')
                ->setUploadDir('public/img/blog')
            
        ];
    }

    
}