<?php

namespace App\Controller;

use DateTime;
use App\Entity\Bet;
use App\Form\BetType;
use App\Entity\Matches;
use App\Repository\BetRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Attribute\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class BetController extends AbstractController
{
    private $entityManager;
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }

    #[Route('/compte/mes-paris', name: 'app_bet')]
    public function index(BetRepository $betRepository): Response
    {
        $user = $this->getUser();
        $bets = $betRepository->findby(['user' => $user]);
        
        return $this->render('bet/index.html.twig', [
            'bets' => $bets,
        ]);
    }

    #[Route('/paris/nouveau-prono/{homeTeam}/{awayTeam}/{matchId}', name: 'app_new_bet')]
    public function new(string $homeTeam, string $awayTeam, int $matchId, EntityManagerInterface $entityManager, Request $request): Response
    {   
        $match = $entityManager->getRepository(Matches::class)->findOneById($matchId);
        $user = $this->getUser();

        $bet = new Bet;
        $bet->setUser($user);
        $bet->setMatches($match);
        $bet->setBetPlacedAt(new DateTime);
        $bet->setBetStatus('pending');
        
        // les variables passées servent à afficher le nom des équipes dans le formulaire
        $form = $this->createForm(BetType::class, $bet, [
            'home_team' => $homeTeam,
            'away_team' => $awayTeam,
            ]);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $this->entityManager->persist($bet);
            $this->entityManager->flush();

            return $this->render('bet/summary.html.twig', [
                'bet' => $bet
            ]);
        }

        return $this->render('bet/new.html.twig', [
            'betForm' => $form->createView(),
        ]);
    }

    #[Route('/paris/recapitulatif/', name: 'app_bet_summary')]
    public function add(): Response
    {   
        return $this->render('bet/summary.html.twig', [
           
        ]);
    }

}
