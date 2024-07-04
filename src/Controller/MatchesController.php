<?php

namespace App\Controller;

use App\Repository\MatchesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MatchesController extends AbstractController
{
    #[Route('/calendrier', name: 'app_matches')]
    public function index(MatchesRepository $matchesRepository): Response
    {
        $allMatches = $matchesRepository->findAll();
        $user = $this->getUser();

        
        return $this->render('matches/index.html.twig', [
            'matches' => $allMatches,
            
        ]);
    }
}
