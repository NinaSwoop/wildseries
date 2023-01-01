<?php

namespace App\Form;

use App\Entity\Actor;
use App\Entity\Program;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\NumberType;
use Symfony\Component\Form\Extension\Core\Type\TextareaType;
use Symfony\Component\Form\Extension\Core\Type\TextType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class ProgramTypePhpType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('title', TextType::class, [
                'label' => 'Nom de la série',
                'attr' => ['placeholder' => 'Ex : Malcolm']
            ])
            ->add('synopsis')
            ->add('poster', TextareaType::class, [
                'label' => "Image",
                'attr' => ['placeholder' => "Saisir l'URL de l'image"]
            ])
            ->add('country', TextType::class, [
                'label' => "Pays",
                'attr' => ['placeholder' => 'Ex : USA']
            ])
            ->add('year', NumberType::class, [
                'label' => "Année",
                'attr' => ['placeholder' => "Ex : 2018"]
            ])
            ->add('category', null, ['choice_label' => 'name'])
            ->add('actors', EntityType::class, [
                'class' => Actor::class,
                'choice_label' => 'lastname',
                'multiple' => true,
                'expanded' => true,
                'by_reference' => false,
                'label' => "Acteurs",
            ]);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Program::class,
        ]);
    }
}
