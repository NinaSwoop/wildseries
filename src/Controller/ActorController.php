<?php

namespace App\Controller;

use App\Entity\Actor;
use App\Entity\Program;
use App\Form\ActorType;
use App\Form\ProgramTypePhpType;
use App\Repository\ActorRepository;
use App\Repository\ProgramRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

class ActorController extends AbstractController
{
    #[Route('/actor', name: 'app_actor')]
    public function index(ActorRepository $actorRepository): Response
    {
        $actors = $actorRepository->findAll();
        return $this->render('actor/index.html.twig', [
            'actors' => $actors,
        ]);
    }

    #[Route('/actor/{id}', name: 'app_show', methods: ['GET'])]
    public function show(Actor $actor): Response
    {
        return $this->render('actor/show_actor.html.twig', [
            'actor' => $actor,
        ]);
    }

    #[Route('/new', name: 'app_new', methods: ['GET', 'POST'])]
    public function new(Request $request, ActorRepository $actorRepository): Response
    {

        $actor = new Actor();
        $form = $this->createForm(ActorType::class, $actor);

        $form->handleRequest($request);
        // Was the form submitted ?
        if ($form->isSubmitted() && $form->isValid()) {

            $actorRepository->save($actor, true);


            $this->addFlash('success', "L'acteur/trice à bien été ajouté(e)");
            // Redirect to actors list
            return $this->redirectToRoute('app_actor');
            // Deal with the submitted data
            // For example : persiste & flush the entity
            // And redirect to a route that display the result
        }
        return $this->renderForm('actor/new.html.twig', [
            'form' => $form,
            'actor' => $actor,
        ]);
    }

    #[Route('/{id}/edit', name: 'app_actor_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, ActorRepository $actorRepository, Actor $actor): Response
    {
        $form = $this->createForm(ActorType::class, $actor);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $actorRepository->save($actor, true);

            $this->addFlash('success', 'La série a bien été modifiée');

            return $this->redirectToRoute('app_actor', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('actor/edit.html.twig', [
            'actor' => $actor,
            'form' => $form,
        ]);
    }

    #[Route('/{id}/delete', name: 'delete', methods: ['POST'])]
    public function delete(Request $request, Actor $actor, ActorRepository $actorRepository): Response
    {
        if ($this->isCsrfTokenValid('delete' . $actor->getId(), $request->request->get('_token'))) {
            $actorRepository->remove($actor, true);
        }

        $this->addFlash('danger', 'The program has been delete');

        return $this->redirectToRoute('app_actor', [], Response::HTTP_SEE_OTHER);
    }
}