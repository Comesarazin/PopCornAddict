<?php

namespace App\Controller;

use App\Entity\UserTvShow;
use App\Form\UserTvShowType;
use App\Service\TmdbApiService;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

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
    
        return $this->render('tvshows/now_playing.html.twig', [
            'tvshows' => $tvshows,
        ]);
    }

    #[Route('/tvshows/{id}', name: 'tvshows_show')]
    public function show(string $id, Request $request, EntityManagerInterface $entityManager, UserInterface $user = null): Response
    {
        $data = $this->tmdbApiService->fetchTvShowData($id);

        $userTvShow = new UserTvShow();
        $userTvShow->setTvShowId($data['id']);
        $userTvShow->setName($data['name']);
        $userTvShow->setOverview($data['overview']);
        $userTvShow->setFirstAirDate($data['first_air_date']);
        $userTvShow->setVoteAverage($data['vote_average']);
        $userTvShow->setVoteCount($data['vote_count']);
        $userTvShow->setNumberOfSeasons($data['number_of_seasons']);
        $userTvShow->setNumberOfEpisodes($data['number_of_episodes']);
        $userTvShow->setOriginalLanguage($data['original_language']);
        $userTvShow->setGenres(json_encode($data['genres']));
        $userTvShow->setProductionCompanies(json_encode($data['production_companies']));

        $form = $this->createForm(UserTvShowType::class, $userTvShow);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $userTvShow->setUser($user);
            $entityManager->persist($userTvShow);
            $entityManager->flush();

            $this->addFlash('success', 'Série ajoutée à votre profil.');

            return $this->redirectToRoute('tvshows_show', ['id' => $id]);
        }

        return $this->render('tvshows/show.html.twig', [
            'data' => $data,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/tvshows/search', name: 'tvshows_search')]
    public function search(Request $request): Response
    {
        $query = $request->query->get('query');

        if (empty($query)) {
            return $this->render('tvshows/search.html.twig', [
                'tvshows' => [],
                'error' => 'Veuillez entrer un terme de recherche.',
            ]);
        }

        $tvshows = $this->tmdbApiService->searchTvShows($query);

        return $this->render('tvshows/search.html.twig', [
            'tvshows' => $tvshows,
        ]);
    }
}