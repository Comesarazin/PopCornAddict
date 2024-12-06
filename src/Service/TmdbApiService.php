<?php
// src/Service/TmdbApiService.php
namespace App\Service;

use Symfony\Contracts\HttpClient\HttpClientInterface;

class TmdbApiService
{
    private $client;
    private $apiBaseUrl;
    private $apiKey;

    public function __construct(HttpClientInterface $client, string $apiBaseUrl, string $apiKey)
    {
        $this->client = $client;
        $this->apiBaseUrl = $apiBaseUrl;
        $this->apiKey = $apiKey;
    }

    public function searchMovies(string $query): array
    {
        try {
            $response = $this->client->request('GET', $this->apiBaseUrl . '/search/movie', [
                'query' => [
                    'query' => $query,
                    'api_key' => $this->apiKey,
                    'language' => 'fr-FR',
                ],
            ]);
            
            return $response->toArray()['results'];
        } catch (\Exception $e) {
            // Gérer l'erreur (par exemple, en journalisant l'erreur et en renvoyant un tableau vide)
            // Vous pouvez également ajouter un message flash pour informer l'utilisateur
            error_log($e->getMessage());
            return [];
        }
    }

    public function fetchMovieData(string $movieId): array
    {
        $response = $this->client->request('GET', $this->apiBaseUrl . '/movie/' . $movieId, [
            'query' => [
                'api_key' => $this->apiKey,
                'language' => 'fr-FR',
            ],
        ]);

        return $response->toArray();
    }

    
    public function fetchNowPlayingMovies(): array
    {
        $response = $this->client->request('GET', $this->apiBaseUrl . '/movie/now_playing', [
            'query' => [
                'api_key' => $this->apiKey,
                'language' => 'fr-FR',
            ],
        ]);
        
        return $response->toArray()['results'];
    }
    
    public function fetchNowPlayingTvShows(): array
    {
        $response = $this->client->request('GET', $this->apiBaseUrl . '/tv/on_the_air', [
            'query' => [
                'api_key' => $this->apiKey,
                'language' => 'fr-FR',
            ],
        ]);
        
        return $response->toArray()['results'];
    }
    
    public function fetchTvShowData(string $tvShowId): array
    {
        $response = $this->client->request('GET', $this->apiBaseUrl . '/tv/' . $tvShowId, [
            'query' => [
                'api_key' => $this->apiKey,
                'language' => 'fr-FR',
            ],
        ]);

        return $response->toArray();
    }

    public function searchTvShows(string $query): array
    {
        try {
            $response = $this->client->request('GET', $this->apiBaseUrl . '/search/tv', [
                'query' => [
                    'api_key' => $this->apiKey,
                    'language' => 'fr-FR',
                    'query' => $query,
                ],
            ]);

            return $response->toArray()['results'];
        } catch (\Exception $e) {
            // Gérer l'erreur (par exemple, en journalisant l'erreur et en renvoyant un tableau vide)
            // Vous pouvez également ajouter un message flash pour informer l'utilisateur
            return [];
        }
    }
}