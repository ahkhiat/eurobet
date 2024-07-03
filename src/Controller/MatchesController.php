<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;

class MatchesController extends AbstractController
{
    #[Route('/calendrier', name: 'app_matches')]
    public function index(): Response
    {
        return $this->render('matches/index.html.twig');
    }
}
