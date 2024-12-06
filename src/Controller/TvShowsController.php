<?php

namespace App\Controller;

use App\Service\TmdbApiService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TvShowsController extends AbstractController
{
    private $tmdbApiService;
    
    public function __construct(TmdbApiService $tmdbApiService)
    {
        $this->tmdbApiService = $tmdbApiService;
    }
    
    
    #[Route('/tvshows', name: 'tvshows_now_playing')]
    public function nowPlaying(): Response
    {
        $tvshows = $this->tmdbApiService->fetchNowPlayingTvShows();
    
        return $this->render('tvShows/now_playing.html.twig', [
            'tvshows' => $tvshows,
        ]);
    }

    #[Route('/tvshows/search', name: 'tvshows_search')]
    public function search(Request $request): Response
    {
        $query = $request->query->get('query');

        if (empty($query)) {
            return $this->render('tvShows/search.html.twig', [
                'tvshows' => [],
                'error' => 'Veuillez entrer un terme de recherche.',
            ]);
        }

        $tvshows = $this->tmdbApiService->searchTvShows($query);

        return $this->render('tvShows/search.html.twig', [
            'tvshows' => $tvshows,
        ]);
    }

    #[Route('/tvshows/{id}', name: 'tvshows_show')]
    public function show(string $id): Response
    {
        $data = $this->tmdbApiService->fetchTvShowData($id);

        return $this->render('tvShows/show.html.twig', [
            'data' => $data,
        ]);
    }

    

}