<?php

namespace App\Entity;

use App\Repository\UserTvShowRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserTvShowRepository::class)]
class UserTvShow
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column(type: 'integer')]
    private $id;

    #[ORM\Column(type: 'integer')]
    private $tvShowId;

    #[ORM\Column(type: 'string', length: 255)]
    private $name;

    #[ORM\Column(type: 'text', nullable: true)]
    private $overview;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $firstAirDate;

    #[ORM\Column(type: 'float', nullable: true)]
    private $voteAverage;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $voteCount;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $numberOfSeasons;

    #[ORM\Column(type: 'integer', nullable: true)]
    private $numberOfEpisodes;

    #[ORM\Column(type: 'string', length: 255, nullable: true)]
    private $originalLanguage;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $genres = null;

    #[ORM\Column(type: 'text', nullable: true)]
    private ?string $productionCompanies = null;

    /**
     * @var Collection<int, User>
     */
    #[ORM\ManyToMany(targetEntity: User::class, mappedBy: 'userTvShows')]
    private Collection $users;

    public function __construct()
    {
        $this->users = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTvShowId(): ?int
    {
        return $this->tvShowId;
    }

    public function setTvShowId(?int $tvShowId): static
    {
        $this->tvShowId = $tvShowId;

        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(string $name): static
    {
        $this->name = $name;

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

    public function getFirstAirDate(): ?string
    {
        return $this->firstAirDate;
    }

    public function setFirstAirDate(string $firstAirDate): static
    {
        $this->firstAirDate = $firstAirDate;

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

    public function getNumberOfSeasons(): ?int
    {
        return $this->numberOfSeasons;
    }

    public function setNumberOfSeasons(int $numberOfSeasons): static
    {
        $this->numberOfSeasons = $numberOfSeasons;

        return $this;
    }

    public function getNumberOfEpisodes(): ?int
    {
        return $this->numberOfEpisodes;
    }

    public function setNumberOfEpisodes(int $numberOfEpisodes): static
    {
        $this->numberOfEpisodes = $numberOfEpisodes;

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

    public function getGenres(): ?string
    {
        return $this->genres;
    }

    public function setGenres(string $genres): self
    {
        $this->genres = $genres;

        return $this;
    }

    public function getProductionCompanies(): ?string
    {
        return $this->productionCompanies;
    }

    public function setProductionCompanies(string $productionCompanies): self
    {
        $this->productionCompanies = $productionCompanies;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): self
    {
        $this->user = $user;

        return $this;
    }

    /**
     * @return Collection<int, User>
     */
    public function getUsers(): Collection
    {
        return $this->users;
    }

    public function addUser(User $user): self
    {
        if (!$this->users->contains($user)) {
            $this->users->add($user);
            $user->addUserTvShow($this);
        }

        return $this;
    }

    public function removeUser(User $user): self
    {
        if ($this->users->removeElement($user)) {
            $user->removeUserTvShow($this);
        }

        return $this;
    }
}
