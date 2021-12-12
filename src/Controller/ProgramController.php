<?php
namespace App\Controller;

use App\Entity\Episode;
use App\Entity\Program;
use App\Entity\Season;
use App\Form\ProgramType;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
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
    public function index(ManagerRegistry $doctrine): Response
    {
        $programs = $doctrine->getRepository(Program::class)
            ->findAll();
        return $this->render('program/index.html.twig', [
            'programs' => $programs,
        ]);
    }
    /**
     * @Route("/new", name="new")
     */
    public function new(Request $request,ManagerRegistry $doctrine): Response
    {
        $program = new Program();
        $entityManager = $doctrine->getManager();
        $form = $this->createForm(ProgramType::class, $program);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $program = $form->getData();
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($program);
            $entityManager->flush();
            return $this->redirectToRoute('program_index');

        }
        return $this->renderForm('program/new.html.twig', [
            'form' => $form,
        ]);
    }
    /**
     * @Route("/{program}/", name="show", methods="GET")
     */
    public function show(Program $program): Response
    {
        $seasons = $this->getDoctrine()
            ->getRepository(Season::class)
            ->findBy(['program' => $program]);

        if(!$program) {
            throw $this->createNotFoundException(
                'Le programme avec l\'id : '. $program->getTitle() .'n\'as pas été trouvé.');
        }
        return $this->render('program/show.html.twig', [
            'program' => $program,
            'seasons' => $seasons,
        ]);
    }
    /**
     * @Route("/{program}/seasons/{season}", name="show_season")
     */
    public function showSeason(Program $program, Season $season, ManagerRegistry $doctrine)
    {
        $episodes = $doctrine->getRepository(Episode::class)
            ->findBySeason($season);

        return $this->render('/program/season_show.html.twig',
        ['program' => $program,
         'season'  => $season,
         'episodes' => $episodes,
        ]);
    }
    /**
     * @Route("/{program}/seasons/{season}/episode/{episode}", name="episode_show")
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

