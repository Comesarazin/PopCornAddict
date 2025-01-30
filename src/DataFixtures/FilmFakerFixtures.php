<?php
// src/DataFixtures/FilmFakerFixtures.php
namespace App\DataFixtures;

use App\Entity\FilmFaker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\FixtureInterface;
use Doctrine\Persistence\ObjectManager;
use Faker\Factory;

class FilmFakerFixtures extends Fixture
{
    public function load(ObjectManager $manager): void
    {
        $faker = Factory::create();

        for ($i = 0; $i < 1000; $i++) {
            $filmFaker = new FilmFaker();
            $filmFaker->setMovieId($faker->numberBetween(1000, 9999));
            $filmFaker->setTitle($faker->sentence(3));
            $filmFaker->setOverview($faker->paragraph);
            $filmFaker->setReleaseDate($faker->date);
            $filmFaker->setVoteAverage($faker->randomFloat(1, 1, 10));
            $filmFaker->setVoteCount($faker->numberBetween(1, 10000));
            $filmFaker->setRuntime($faker->numberBetween(80, 180));
            $filmFaker->setOriginalLanguage($faker->languageCode);
            $filmFaker->setBudget($faker->numberBetween(1000000, 100000000));
            $filmFaker->setRevenue($faker->numberBetween(1000000, 1000000000));
            $filmFaker->setGenres($faker->words(3, true));
            $filmFaker->setProductionCompanies($faker->company);

            $manager->persist($filmFaker);
        }

        $manager->flush();
    }
}