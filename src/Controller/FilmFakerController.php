<?php

namespace App\Controller;

use App\Entity\FilmFaker;
use App\Form\FilmFakerType;
use App\Repository\FilmFakerRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

#[Route('/film/faker')]
final class FilmFakerController extends AbstractController
{
    #[Route(name: 'app_film_faker_index', methods: ['GET'])]
    public function index(FilmFakerRepository $filmFakerRepository): Response
    {
        return $this->render('film_faker/index.html.twig', [
            'film_fakers' => $filmFakerRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_film_faker_new', methods: ['GET', 'POST'])]
    public function new(Request $request, EntityManagerInterface $entityManager): Response
    {
        $filmFaker = new FilmFaker();
        $form = $this->createForm(FilmFakerType::class, $filmFaker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->persist($filmFaker);
            $entityManager->flush();

            return $this->redirectToRoute('app_film_faker_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('film_faker/new.html.twig', [
            'film_faker' => $filmFaker,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_film_faker_show', methods: ['GET'])]
    public function show(FilmFaker $filmFaker): Response
    {
        return $this->render('film_faker/show.html.twig', [
            'film_faker' => $filmFaker,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_film_faker_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, FilmFaker $filmFaker, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(FilmFakerType::class, $filmFaker);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('app_film_faker_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('film_faker/edit.html.twig', [
            'film_faker' => $filmFaker,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_film_faker_delete', methods: ['POST'])]
    public function delete(Request $request, FilmFaker $filmFaker, EntityManagerInterface $entityManager): Response
    {
        if ($this->isCsrfTokenValid('delete'.$filmFaker->getId(), $request->request->get('_token'))) {
            $entityManager->remove($filmFaker);
            $entityManager->flush();
        }

        return $this->redirectToRoute('app_film_faker_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/add', name: 'app_film_faker_add', methods: ['POST'])]
    public function add(FilmFaker $filmFaker, EntityManagerInterface $entityManager, UserInterface $user): Response
    {
        $user->addFilmFaker($filmFaker);
        $entityManager->persist($user);
        $entityManager->flush();

        $this->addFlash('success', 'Film ajouté à votre profil.');

        return $this->redirectToRoute('app_film_faker_show', ['id' => $filmFaker->getId()]);
    }
}
