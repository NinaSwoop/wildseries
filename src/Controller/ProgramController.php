<?php

namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Repository\ProgramRepository;
use App\Repository\SeasonRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Entity;
use App\Form\ProgramTypePhpType;
use Symfony\Component\HttpFoundation\Request;

#[Route('/program', name: 'program_')]
class ProgramController extends AbstractController
{
    #[Route('/', name: 'index')]
    public function index(ProgramRepository $programRepository): Response
    {
        $programs = $programRepository->findAll();

        return $this->render(
            'program/index.html.twig',
            ['programs' => $programs]
        );
    }

    #[Route('/new', name: 'new')]
    public function new(Request $request, ProgramRepository $programRepository): Response
    {
        $program = new Program();

        // Create the form, linked with $category
        $form = $this->createForm(ProgramTypePhpType::class, $program);

        $form->handleRequest($request);
        // Was the form submitted ?
        if ($form->isSubmitted() && $form->isValid()) {
            $programRepository->save($program, true);

            // Redirect to categories list
            return $this->redirectToRoute('program_index');
            // Deal with the submitted data
            // For example : persiste & flush the entity
            // And redirect to a route that display the result
        }
        // Render the form (best practice)
        return $this->renderForm('program/new.html.twig', [
            'form' => $form,
        ]);

        // Alternative
        // return $this->render('category/new.html.twig', [
        //   'form' => $form->createView(),
        // ]);
    }

    #[Route('/show/{id<^[0-9]+$>}', methods: ['GET'], name: 'show')]
    public function show(int $id, ProgramRepository $programRepository): Response
    {
        $program = $programRepository->findOneBy(['id' => $id]);
        // same as $program = $programRepository->find($id);

        if (!$program) {
            throw $this->createNotFoundException(
                'No program with id : ' . $id . ' found in program\'s table.'
            );
        }
        return $this->render('program/show.html.twig', [
            'program' => $program,
        ]);
    }

    #[Route('/{programId}/seasons/{seasonId}', methods: ['GET'], name: 'season_show')]
    public function showSeason(int $programId, int $seasonId, SeasonRepository $seasonRepository, ProgramRepository $programRepository): Response
    {
        $season = $seasonRepository->findOneBy(['id' => $seasonId]);
        $program = $programRepository->findOneBy(['id' => $programId]);

        if (!$season) {
            throw $this->createNotFoundException(
                'No program with id : ' . $seasonId . ' found in program\'s table.'
            );
        }
        return $this->render('program/season_show.html.twig', [
            'program' => $program,
            'season' => $season,
        ]);
    }
    #[Route('/{programId}/seasons/{seasonId}/episode/{episodeId}', methods: ['GET'], name: 'episode_show')]
    #[Entity('program', options: ['mapping' => ['programId' => 'id']])]
    #[Entity('season', options: ['mapping' => ['seasonId' => 'id']])]
    #[Entity('episode', options: ['mapping' => ['episodeId' => 'id']])]
    public function showEpisode(Program $program, Season $season, Episode $episode): Response
    {

        return $this->render('program/episode_show.html.twig', [
            'program' => $program,
            'season' => $season,
            'episode' => $episode,
        ]);
    }
}
