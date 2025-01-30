<?php
// src/Form/UserTvShowType.php
namespace App\Form;

use App\Entity\UserTvShow;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\Extension\Core\Type\HiddenType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Component\OptionsResolver\OptionsResolver;

class UserTvShowType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $builder
            ->add('tvShowId', HiddenType::class)
            ->add('name', HiddenType::class)
            ->add('overview', HiddenType::class)
            ->add('firstAirDate', HiddenType::class)
            ->add('voteAverage', HiddenType::class)
            ->add('voteCount', HiddenType::class)
            ->add('numberOfSeasons', HiddenType::class)
            ->add('numberOfEpisodes', HiddenType::class)
            ->add('originalLanguage', HiddenType::class)
            ->add('genres', HiddenType::class)
            ->add('productionCompanies', HiddenType::class);
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => UserTvShow::class,
        ]);
    }
}