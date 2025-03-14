<?php

namespace App\Controller\Admin;

use App\Entity\Tag;
use App\Entity\TagTranslation;
use App\Form\TagTranslationType;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\FormField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ColorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\CollectionField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use Symfony\Component\EventDispatcher\EventSubscriberInterface;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityPersistedEvent;
use EasyCorp\Bundle\EasyAdminBundle\Event\BeforeEntityUpdatedEvent;

class TagCrudController extends AbstractCrudController implements EventSubscriberInterface
{
    public static function getEntityFqcn(): string
    {
        return Tag::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setPageTitle('index', 'Tags')
            ->setPageTitle('new', 'Ajouter un Tag')
            ->setDefaultSort(['id' => 'ASC'])
            ->setPaginatorPageSize(10)
            ->setEntityLabelInSingular('Tag')
            ->setEntityLabelInPlural('Tags');
    }

    public static function getSubscribedEvents(): array
    {
        return [
            BeforeEntityPersistedEvent::class => 'persistTranslations',
            BeforeEntityUpdatedEvent::class => 'persistTranslations',
        ];
    }

    public function persistTranslations($event)
    {
        $entity = $event->getEntityInstance();
        if (!$entity instanceof Tag) {
            return;
        }

        foreach ($entity->getTranslations() as $translation) {
            $translation->setTag($entity); // Correction ici (c'était `setArticle()`)
        }
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id', 'ID')->onlyOnIndex(),

            FormField::addPanel('Informations du Tag'),
            TextField::new('name', 'Nom du tag'),
            TextField::new('slug', 'Slug')
                ->setFormTypeOptions(['disabled' => true])
                ->onlyOnIndex(),

            ColorField::new('color', 'Couleur du tag')
                ->setHelp('Choisissez une couleur pour le tag'),

            FormField::addPanel('Traductions'),
            CollectionField::new('translations', 'Traductions')
                ->setEntryType(TagTranslationType::class)
                ->setFormTypeOptions(['by_reference' => false])
        ];
    }
}
