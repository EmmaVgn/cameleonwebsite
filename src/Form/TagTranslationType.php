<?php

namespace App\Form;

use App\Entity\TagTranslation;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\Extension\Core\Type\ChoiceType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class TagTranslationType extends AbstractType
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
            ->add('name', TextType::class, [
                'label' => 'Nom du Tag',
            ]);
    }

    public function configureOptions(OptionsResolver $resolver)
    {
        $resolver->setDefaults([
            'data_class' => TagTranslation::class,
        ]);
    }
}
