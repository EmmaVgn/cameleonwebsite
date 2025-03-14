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
use EasyCorp\Bundle\EasyAdminBundle\Field\DateTimeField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextareaField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use App\Form\ArticleTranslationType;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class ArticleCrudController extends AbstractCrudController implements EventSubscriberInterface
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

    public static function getSubscribedEvents()
    {
        return [
            BeforeEntityPersistedEvent::class => 'persistTranslations',
            BeforeEntityUpdatedEvent::class => 'persistTranslations',
        ];
    }

    public function persistTranslations($event)
    {
        $entity = $event->getEntityInstance();
        if (!($entity instanceof Article)) {
            return;
        }

        foreach ($entity->getTranslations() as $translation) {
            $translation->setArticle($entity);
        }
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            TextField::new('name', 'Titre'),
            TextareaField::new('subtitle', 'Sous-titre'),
            TextEditorField::new('content', 'Contenu'),
            AssociationField::new('tags', 'Tags')
            ->setFormTypeOptions([
                'by_reference' => false, // Important pour les relations ManyToMany
            ]),        
            SlugField::new('slug')
                ->setTargetFieldName('name'), // Spécifie le champ utilisé pour générer le slug
                ImageField::new('imageName')
                ->setBasePath('img/blog/')
                ->setUploadDir('public/img/blog'),
            CollectionField::new('translations', 'Traductions')
               ->setEntryType(ArticleTranslationType::class)
               ->setFormTypeOptions(['by_reference' => false]),
            
        ];
    }

    
}