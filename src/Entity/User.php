<?php

namespace App\Entity;

use App\Repository\UserRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;
use Symfony\Bridge\Doctrine\Validator\Constraints\UniqueEntity;
use Symfony\Component\Security\Core\User\PasswordAuthenticatedUserInterface;
use Symfony\Component\Security\Core\User\UserInterface;

#[ORM\Entity(repositoryClass: UserRepository::class)]
#[UniqueEntity(fields: ['email'], message: 'There is already an account with this email')]
class User implements UserInterface, PasswordAuthenticatedUserInterface
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 180, unique: true)]
    private ?string $email = null;

    #[ORM\Column]
    private array $roles = [];

    #[ORM\Column]
    private ?string $password = null;

    #[ORM\Column(length: 255)]
    private ?string $prenom = null;

    #[ORM\Column(length: 255)]
    private ?string $nom = null;

    #[ORM\Column]
    private bool $isVerified = false;

    /**
     * @var Collection<int, UserMovie>
     */
    #[ORM\ManyToMany(targetEntity: UserMovie::class, inversedBy: 'users')]
    private Collection $userMovies;

    /**
     * @var Collection<int, UserTvShow>
     */
    #[ORM\ManyToMany(targetEntity: UserTvShow::class, inversedBy: 'users')]
    private Collection $userTvShows;

    /**
     * @var Collection<int, FilmFaker>
     */
    #[ORM\ManyToMany(targetEntity: FilmFaker::class, inversedBy: 'users')]
    private Collection $filmFakers;

    public function __construct()
    {
        $this->userMovies = new ArrayCollection();
        $this->userTvShows = new ArrayCollection();
        $this->filmFakers = new ArrayCollection();
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getEmail(): ?string
    {
        return $this->email;
    }

    public function setEmail(string $email): static
    {
        $this->email = $email;

        return $this;
    }

    /**
     * A visual identifier that represents this user.
     *
     * @see UserInterface
     */
    public function getUserIdentifier(): string
    {
        return (string) $this->email;
    }

    /**
     * @see UserInterface
     *
     * @return list<string>
     */
    public function getRoles(): array
    {
        $roles = $this->roles;
        // guarantee every user at least has ROLE_USER
        $roles[] = 'ROLE_USER';

        return array_unique($roles);
    }

    /**
     * @param list<string> $roles
     */
    public function setRoles(array $roles): static
    {
        $this->roles = $roles;

        return $this;
    }

    /**
     * @see PasswordAuthenticatedUserInterface
     */
    public function getPassword(): ?string
    {
        return $this->password;
    }

    public function setPassword(string $password): static
    {
        $this->password = $password;

        return $this;
    }

    /**
     * @see UserInterface
     */
    public function eraseCredentials(): void
    {
        // If you store any temporary, sensitive data on the user, clear it here
        // $this->plainPassword = null;
    }

    public function getPrenom(): ?string
    {
        return $this->prenom;
    }

    public function setPrenom(string $prenom): static
    {
        $this->prenom = $prenom;

        return $this;
    }

    public function getNom(): ?string
    {
        return $this->nom;
    }

    public function setNom(string $nom): static
    {
        $this->nom = $nom;

        return $this;
    }

    public function isVerified(): bool
    {
        return $this->isVerified;
    }

    public function setVerified(bool $isVerified): static
    {
        $this->isVerified = $isVerified;

        return $this;
    }

    /**
     * @return Collection<int, UserMovie>
     */
    public function getUserMovies(): Collection
    {
        return $this->userMovies;
    }

    public function addUserMovie(UserMovie $userMovie): static
    {
        if (!$this->userMovies->contains($userMovie)) {
            $this->userMovies->add($userMovie);
            $userMovie->addUser($this);
        }

        return $this;
    }

    public function removeUserMovie(UserMovie $userMovie): static
    {
        if ($this->userMovies->removeElement($userMovie)) {
            $userMovie->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, UserTvShow>
     */
    public function getUserTvShows(): Collection
    {
        return $this->userTvShows;
    }

    public function addUserTvShow(UserTvShow $userTvShow): static
    {
        if (!$this->userTvShows->contains($userTvShow)) {
            $this->userTvShows->add($userTvShow);
            $userTvShow->addUser($this);
        }

        return $this;
    }

    public function removeUserTvShow(UserTvShow $userTvShow): static
    {
        if ($this->userTvShows->removeElement($userTvShow)) {
            $userTvShow->removeUser($this);
        }

        return $this;
    }

    /**
     * @return Collection<int, FilmFaker>
     */
    public function getFilmFakers(): Collection
    {
        return $this->filmFakers;
    }

    public function addFilmFaker(FilmFaker $filmFaker): static
    {
        if (!$this->filmFakers->contains($filmFaker)) {
            $this->filmFakers->add($filmFaker);
            $filmFaker->addUser($this);
        }

        return $this;
    }

    public function removeFilmFaker(FilmFaker $filmFaker): static
    {
        if ($this->filmFakers->removeElement($filmFaker)) {
            $filmFaker->removeUser($this);
        }

        return $this;
    }
}
