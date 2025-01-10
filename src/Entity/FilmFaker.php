<?php

namespace App\Entity;

use App\Repository\FilmFakerRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: FilmFakerRepository::class)]
class FilmFaker
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column]
    private ?int $movieId = null;

    #[ORM\Column(length: 255)]
    private ?string $title = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $overview = null;

    #[ORM\Column(length: 255)]
    private ?string $releaseDate = null;

    #[ORM\Column]
    private ?float $voteAverage = null;

    #[ORM\Column]
    private ?int $voteCount = null;

    #[ORM\Column]
    private ?int $runtime = null;

    #[ORM\Column(length: 255)]
    private ?string $originalLanguage = null;

    #[ORM\Column]
    private ?int $budget = null;

    #[ORM\Column]
    private ?int $revenue = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $genres = null;

    #[ORM\Column(type: Types::TEXT)]
    private ?string $productionCompanies = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, inversedBy: 'filmFakers')]
    private Collection $UserFilmFaker;

    public function __construct()
    {
        $this->UserFilmFaker = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getMovieId(): ?int
    {
        return $this->movieId;
    }

    public function setMovieId(int $movieId): static
    {
        $this->movieId = $movieId;

        return $this;
    }

    public function getTitle(): ?string
    {
        return $this->title;
    }

    public function setTitle(string $title): static
    {
        $this->title = $title;

        return $this;
    }

    public function getOverview(): ?string
    {
        return $this->overview;
    }

    public function setOverview(string $overview): static
    {
        $this->overview = $overview;

        return $this;
    }

    public function getReleaseDate(): ?string
    {
        return $this->releaseDate;
    }

    public function setReleaseDate(string $releaseDate): static
    {
        $this->releaseDate = $releaseDate;

        return $this;
    }

    public function getVoteAverage(): ?float
    {
        return $this->voteAverage;
    }

    public function setVoteAverage(float $voteAverage): static
    {
        $this->voteAverage = $voteAverage;

        return $this;
    }

    public function getVoteCount(): ?int
    {
        return $this->voteCount;
    }

    public function setVoteCount(int $voteCount): static
    {
        $this->voteCount = $voteCount;

        return $this;
    }

    public function getRuntime(): ?int
    {
        return $this->runtime;
    }

    public function setRuntime(int $runtime): static
    {
        $this->runtime = $runtime;

        return $this;
    }

    public function getOriginalLanguage(): ?string
    {
        return $this->originalLanguage;
    }

    public function setOriginalLanguage(string $originalLanguage): static
    {
        $this->originalLanguage = $originalLanguage;

        return $this;
    }

    public function getBudget(): ?int
    {
        return $this->budget;
    }

    public function setBudget(int $budget): static
    {
        $this->budget = $budget;

        return $this;
    }

    public function getRevenue(): ?int
    {
        return $this->revenue;
    }

    public function setRevenue(int $revenue): static
    {
        $this->revenue = $revenue;

        return $this;
    }

    public function getGenres(): ?string
    {
        return $this->genres;
    }

    public function setGenres(string $genres): static
    {
        $this->genres = $genres;

        return $this;
    }

    public function getProductionCompanies(): ?string
    {
        return $this->productionCompanies;
    }

    public function setProductionCompanies(string $productionCompanies): static
    {
        $this->productionCompanies = $productionCompanies;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUserFilmFaker(): Collection
    {
        return $this->UserFilmFaker;
    }

    public function addUserFilmFaker(User $userFilmFaker): static
    {
        if (!$this->UserFilmFaker->contains($userFilmFaker)) {
            $this->UserFilmFaker->add($userFilmFaker);
        }

        return $this;
    }

    public function removeUserFilmFaker(User $userFilmFaker): static
    {
        $this->UserFilmFaker->removeElement($userFilmFaker);

        return $this;
    }
}
