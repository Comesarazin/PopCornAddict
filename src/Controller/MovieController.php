<?php
// src/Controller/MovieController.php
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

    #[Route('/', name: 'home')]
    public function home(): Response
    {
        return $this->render('home.html.twig');
    }

    #[Route('/movie/{id}', name: 'movie_show')]
    public function show(string $id, Request $request): Response
    {
        $type = $request->query->get('type', 'movie');
        if ($type === 'tv') {
            $data = $this->tmdbApiService->fetchTvShowData($id);
        } else {
            $data = $this->tmdbApiService->fetchMovieData($id);
        }

        return $this->render('movie/show.html.twig', [
            'data' => $data,
            'type' => $type,
        ]);
    }

    #[Route('/search', name: 'movie_search')]
    public function search(Request $request): Response
    {
        $query = $request->query->get('query');

        if (empty($query)) {
            return $this->render('movie/search.html.twig', [
                'movies' => [],
                'tvShows' => [],
                'error' => 'Veuillez entrer un terme de recherche.',
            ]);
        }

        $movies = $this->tmdbApiService->searchMovies($query);
        $tvShows = $this->tmdbApiService->searchTvShows($query);

        return $this->render('movie/search.html.twig', [
            'movies' => $movies,
            'tvShows' => $tvShows,
        ]);
    }
}