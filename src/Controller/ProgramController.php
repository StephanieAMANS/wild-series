<?php
namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

    /**
    * @Route("/program", name="program_")
    */
Class ProgramController extends AbstractController

{
    /**
     * @Route("/", name="index")
     */
    public function index(): Response
    {
        $programs = $this->getDoctrine()
            ->getRepository(Program::class)
            ->findAll();
        return $this->render('program/index.html.twig', [
            'programs' => $programs,
        ]);
    }

    /**
     * @Route("/{id}/", name="show")
     */
    public function show(Program $program): Response
    {
        $seasons = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findBy(['program' => $program]);

        if(!$program) {
            throw $this->createNotFoundException(
                'No program with id : '.$program.'found in program\'s table.'
            );
        }
        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $seasons,
        ]);
    }
    /**
     * @Route("/{program}/seasons/{season}", name="show_season")
     */
    public function showSeason(Program $program, Season $season)
    {
        $episodes = $this->getDoctrine()
            ->getRepository(Episode::class)
            ->findBySeason($season);

        return $this->render('/program/season_show.html.twig',
        ['program' => $program,
         'season'  => $season,
         'episodes' => $episodes,
        ]);
}
    /**
     * @Route("/{programId}/seasons/{seasonId}/episode/{episodeId}", name="episode_show")
     */
    public function showEpisode(Program $program, Season $season, Episode $episode)
    {
        return $this->render('/program/episode_show.html.twig',
            ['program' => $program,
                'season'  => $season,
                'episode' => $episode,
            ]);
    }
}

