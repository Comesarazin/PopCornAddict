<?php

namespace App\Controller;

use App\Entity\UserMovie;
use App\Entity\User;
use App\Form\UserMovieType;
use App\Service\TmdbApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

class MovieController extends AbstractController
{
    private $tmdbApiService;

    public function __construct(TmdbApiService $tmdbApiService)
    {
        $this->tmdbApiService = $tmdbApiService;
    }
    
    #[Route('/movie', name: 'movie_now_playing')]
    public function nowPlaying(): Response
    {
        $movies = $this->tmdbApiService->fetchNowPlayingMovies();

        return $this->render('movie/now_playing.html.twig', [
            'movies' => $movies,
        ]);
    }

    #[Route('/movie/{id}', name: 'movie_show')]
    public function show(string $id, Request $request, EntityManagerInterface $entityManager, UserInterface $user = null): Response
    {
        $data = $this->tmdbApiService->fetchMovieData($id);

        $userMovie = new UserMovie();
        $userMovie->setMovieId($data['id']);
        $userMovie->setTitle($data['title']);
        $userMovie->setOverview($data['overview']);
        $userMovie->setReleaseDate($data['release_date']);
        $userMovie->setVoteAverage($data['vote_average']);
        $userMovie->setVoteCount($data['vote_count']);
        $userMovie->setRuntime($data['runtime']);
        $userMovie->setOriginalLanguage($data['original_language']);
        $userMovie->setBudget($data['budget']);
        $userMovie->setRevenue($data['revenue']);
        $userMovie->setGenres(json_encode($data['genres']));
        $userMovie->setProductionCompanies(json_encode($data['production_companies']));

        $form = $this->createForm(UserMovieType::class, $userMovie);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userMovie->addUser($user);
            $entityManager->persist($userMovie);
            $entityManager->flush();

            $this->addFlash('success', 'Film ajouté à votre profil.');

            return $this->redirectToRoute('movie_show', ['id' => $id]);
        }

        return $this->render('movie/show.html.twig', [
            'data' => $data,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/movie/search', name: 'movie_search')]
    public function search(Request $request): Response
    {
        $query = $request->query->get('query');

        if (empty($query)) {
            return $this->render('movie/search.html.twig', [
                'movies' => [],
                'error' => 'Veuillez entrer un terme de recherche.',
            ]);
        }

        $movies = $this->tmdbApiService->searchMovies($query);

        return $this->render('movie/search.html.twig', [
            'movies' => $movies,
        ]);
    }
}