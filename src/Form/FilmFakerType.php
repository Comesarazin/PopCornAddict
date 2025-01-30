<?php

namespace App\Form;

use App\Entity\FilmFaker;
use App\Entity\User;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class FilmFakerType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('movieId')
            ->add('title')
            ->add('overview')
            ->add('releaseDate')
            ->add('voteAverage')
            ->add('voteCount')
            ->add('runtime')
            ->add('originalLanguage')
            ->add('budget')
            ->add('revenue')
            ->add('genres')
            ->add('productionCompanies')
            ->add('UserFilmFaker', EntityType::class, [
                'class' => User::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => FilmFaker::class,
        ]);
    }
}
