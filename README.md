# PopCornAddict

## Introduction

PopCornAddict est une application web permettant de rechercher des films et des séries TV, de les ajouter à votre profil et de consulter les informations détaillées sur chaque film ou série.

## Technologies Utilisées

- **Symfony** : Framework PHP pour le développement d'applications web.
- **Doctrine ORM** : Bibliothèque de mapping objet-relationnel pour PHP.
- **Twig** : Moteur de templates pour PHP.
- **Symfony Security** : Composant de sécurité pour la gestion de l'authentification et de l'autorisation.
- **Symfony Forms** : Composant pour la gestion des formulaires.
- **Symfony Validator** : Composant pour la validation des données.
- **Symfony HTTP Client** : Composant pour effectuer des requêtes HTTP.
- **Composer** : Gestionnaire de dépendances pour PHP.
- **Webpack Encore** : Outil de compilation d'actifs front-end.
- **Bootstrap** : Framework CSS pour la conception de sites web réactifs.
- **JavaScript** : Langage de programmation pour le développement front-end.
- **HTML5** : Langage de balisage pour la structuration du contenu web.
- **CSS3** : Langage de style pour la présentation du contenu web.
- **MySQL** : Système de gestion de base de données relationnelle.

## Routes

### Home

- **Route**: `/`
- **Controller**: `App\Controller\HomeController::home`
- **Description**: Page d'accueil de l'application.

### Movies

- **Route**: `/movie`
- **Controller**: `App\Controller\MovieController::nowPlaying`
- **Description**: Affiche les films actuellement en salle.

- **Route**: `/movie/{id}`
- **Controller**: `App\Controller\MovieController::show`
- **Description**: Affiche les détails d'un film spécifique.
- **Paramètres**:
  - `id`: Identifiant du film.

- **Route**: `/movie/search`
- **Controller**: `App\Controller\MovieController::search`
- **Description**: Recherche des films par titre.
- **Paramètres**:
  - `query`: Terme de recherche.

### TV Shows

- **Route**: `/tvshows`
- **Controller**: `App\Controller\TvShowsController::nowPlaying`
- **Description**: Affiche les séries TV actuellement diffusées.

- **Route**: `/tvshows/{id}`
- **Controller**: `App\Controller\TvShowsController::show`
- **Description**: Affiche les détails d'une série TV spécifique.
- **Paramètres**:
  - `id`: Identifiant de la série TV.

- **Route**: `/tvshows/search`
- **Controller**: `App\Controller\TvShowsController::search`
- **Description**: Recherche des séries TV par titre.
- **Paramètres**:
  - `query`: Terme de recherche.

### Users

- **Route**: `/user`
- **Controller**: `App\Controller\UserController::index`
- **Description**: Affiche la liste des utilisateurs.

- **Route**: `/user/new`
- **Controller**: `App\Controller\UserController::new`
- **Description**: Crée un nouvel utilisateur.

- **Route**: `/user/profile`
- **Controller**: `App\Controller\UserController::profile`
- **Description**: Affiche le profil de l'utilisateur connecté.

- **Route**: `/user/{id}`
- **Controller**: `App\Controller\UserController::show`
- **Description**: Affiche les détails d'un utilisateur spécifique.
- **Paramètres**:
  - `id`: Identifiant de l'utilisateur.

- **Route**: `/user/{id}/edit`
- **Controller**: `App\Controller\UserController::edit`
- **Description**: Modifie les informations d'un utilisateur spécifique.
- **Paramètres**:
  - `id`: Identifiant de l'utilisateur.

- **Route**: `/user/{id}`
- **Controller**: `App\Controller\UserController::delete`
- **Description**: Supprime un utilisateur spécifique.
- **Paramètres**:
  - `id`: Identifiant de l'utilisateur.

### FilmFaker

- **Route**: `/film/faker`
- **Controller**: `App\Controller\FilmFakerController::index`
- **Description**: Affiche la liste des films factices.

- **Route**: `/film/faker/new`
- **Controller**: `App\Controller\FilmFakerController::new`
- **Description**: Crée un nouveau film factice.

- **Route**: `/film/faker/{id}`
- **Controller**: `App\Controller\FilmFakerController::show`
- **Description**: Affiche les détails d'un film factice spécifique.
- **Paramètres**:
  - `id`: Identifiant du film factice.

- **Route**: `/film/faker/{id}/edit`
- **Controller**: `App\Controller\FilmFakerController::edit`
- **Description**: Modifie les informations d'un film factice spécifique.
- **Paramètres**:
  - `id`: Identifiant du film factice.

- **Route**: `/film/faker/{id}/add`
- **Controller**: `App\Controller\FilmFakerController::add`
- **Description**: Ajoute un film factice au profil de l'utilisateur.
- **Paramètres**:
  - `id`: Identifiant du film factice.

- **Route**: `/film/faker/{id}`
- **Controller**: `App\Controller\FilmFakerController::delete`
- **Description**: Supprime un film factice spécifique.
- **Paramètres**:
  - `id`: Identifiant du film factice.

### Authentication

- **Route**: `/register`
- **Controller**: `App\Controller\RegistrationController::register`
- **Description**: Page d'inscription.

- **Route**: `/verify/email`
- **Controller**: `App\Controller\RegistrationController::verifyUserEmail`
- **Description**: Vérifie l'adresse email de l'utilisateur.

- **Route**: `/login`
- **Controller**: `App\Controller\SecurityController::login`
- **Description**: Page de connexion.

- **Route**: `/logout`
- **Controller**: `App\Controller\SecurityController::logout`
- **Description**: Déconnexion de l'utilisateur.

## Configuration

### Variables d'environnement

- **API_BASE_URL**: URL de base de l'API TMDB.
- **API_KEY**: Clé API pour accéder à l'API TMDB.

### Fichiers de configuration

- **.env**: Fichier de configuration des variables d'environnement.
- **config/packages/**: Dossier contenant les fichiers de configuration des packages Symfony.
- **config/routes/**: Dossier contenant les fichiers de configuration des routes.



