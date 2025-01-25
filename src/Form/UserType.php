<?php

namespace App\Form;

use App\Entity\FilmFaker;
use App\Entity\User;
use App\Entity\UserMovie;
use App\Entity\UserTvShow;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('email')
            ->add('roles')
            ->add('password')
            ->add('prenom')
            ->add('nom')
            ->add('isVerified')
            ->add('userMovies', EntityType::class, [
                'class' => UserMovie::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('userTvShows', EntityType::class, [
                'class' => UserTvShow::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
            ->add('filmFakers', EntityType::class, [
                'class' => FilmFaker::class,
                'choice_label' => 'id',
                'multiple' => true,
            ])
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => User::class,
        ]);
    }
}
