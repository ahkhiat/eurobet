<?php

namespace App\Controller;

use http\Client;
use App\Service\FootballApiService;
use App\Repository\MatchesRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class MatchesController extends AbstractController
{
    private $footballApiService;

    public function __construct(FootballApiService $footballApiService)
    {
        $this->footballApiService = $footballApiService;
    }

    #[Route('/calendrier', name: 'app_matches')]
    public function index(MatchesRepository $matchesRepository): Response
    {

        $allMatches = $matchesRepository->findAll();

        $parameters = [
            'league' => '61', 
            'season' => '2024', 
        ];

        $data = $this->footballApiService->fetchData('fixtures', $parameters);
        $matches = $data['response'];

        
        return $this->render('matches/index.html.twig', [
            'matches' => $allMatches,
            'data' => $data,
            'matchesLeague' => $matches
        ]);
    }
    #[Route('/calendrier/2023', name: 'app_matches_2023')]
    public function lastYear(MatchesRepository $matchesRepository): Response
    {

        $allMatches = $matchesRepository->findAll();

        $parameters = [
            'league' => '61', 
            'season' => '2023', 
        ];

        $data = $this->footballApiService->fetchData('fixtures', $parameters);
        $matches = $data['response'];

        
        return $this->render('matches/index.html.twig', [
            'matches' => $allMatches,
            'data' => $data,
            'matchesLeague' => $matches
        ]);
    }
}
