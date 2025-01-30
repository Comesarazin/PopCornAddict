<?php
// src/Form/UserMovieType.php
namespace App\Form;

use App\Entity\UserMovie;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserMovieType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('movieId', HiddenType::class)
            ->add('title', HiddenType::class)
            ->add('overview', HiddenType::class)
            ->add('releaseDate', HiddenType::class)
            ->add('voteAverage', HiddenType::class)
            ->add('voteCount', HiddenType::class)
            ->add('runtime', HiddenType::class)
            ->add('originalLanguage', HiddenType::class)
            ->add('budget', HiddenType::class)
            ->add('revenue', HiddenType::class)
            ->add('genres', HiddenType::class)
            ->add('productionCompanies', HiddenType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserMovie::class,
        ]);
    }
}