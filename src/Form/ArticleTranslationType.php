<?php

namespace App\Form;

use App\Entity\ArticleTranslation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ArticleTranslationType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options)
    {
        $builder
            ->add('locale', ChoiceType::class, [
                'choices' => [
                    'Français' => 'fr',
                    'English' => 'en',
                    'Español' => 'es',
                ],
                'label' => 'Langue',
            ])
            ->add('name', TextType::class, ['label' => 'Titre'])
            ->add('subtitle', TextType::class, ['label' => 'Sous-titre', 'required' => false])
            ->add('content', TextareaType::class, ['label' => 'Contenu', 'required' => false]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => ArticleTranslation::class,
        ]);
    }
}
