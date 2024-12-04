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

    public function searchMovies(string $query): array
    {
        $response = $this->client->request('GET', $this->apiBaseUrl . '/search/movie', [
            'query' => [
                'api_key' => $this->apiKey,
                'query' => $query,
                'language' => 'fr-FR',
            ],
        ]);

        return $response->toArray()['results'];
    }

    public function searchTvShows(string $query): array
    {
        $response = $this->client->request('GET', $this->apiBaseUrl . '/search/tv', [
            'query' => [
                'api_key' => $this->apiKey,
                'query' => $query,
                'language' => 'fr-FR',
            ],
        ]);

        return $response->toArray()['results'];
    }
}