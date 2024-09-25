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
            TextField::new('title', 'Titre'),
            TextareaField::new('subtitle', 'Sous-titre'),
            TextareaField::new('content', 'Contenu'),
            SlugField::new('slug')
                ->setTargetFieldName('title') // Spécifie le champ utilisé pour générer le slug
                ->setFormTypeOptions(['disabled' => true]), // Rendre le champ slug non modifiable dans le formulaire
            ImageField::new('image', 'Image')
                ->setBasePath('img/blog/')
                ->setUploadDir('public/img/blog')
                ->setRequired(false) // Si vous ne voulez pas que ce champ soit requis
                ->setFormTypeOptions([
                    'help' => 'Téléchargez une image pour cet article.'
                ])
            
        ];
    }

    
}
