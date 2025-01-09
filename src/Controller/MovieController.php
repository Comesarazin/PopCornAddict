<?php

namespace App\Controller;

use App\Service\TmdbApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

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

    #[Route('/movie/{id}', name: 'movie_show')]
    public function show(string $id): Response
    {
        $data = $this->tmdbApiService->fetchMovieData($id);

        return $this->render('movie/show.html.twig', [
            'data' => $data,
        ]);
    }


}