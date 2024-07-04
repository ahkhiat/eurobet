<?php

namespace App\Entity;

use App\Repository\BetRepository;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: BetRepository::class)]
class Bet
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(type: Types::DATETIME_MUTABLE)]
    private ?\DateTimeInterface $BetPlacedAt = null;

    #[ORM\Column(length: 255)]
    private ?string $BetStatus = null;

    #[ORM\ManyToOne(inversedBy: 'bets')]
    private ?User $user = null;

    #[ORM\ManyToOne(inversedBy: 'bets')]
    private ?Matches $matches = null;

    #[ORM\Column]
    private ?int $homeScore = null;

    #[ORM\Column]
    private ?int $awayScore = null;

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getBetPlacedAt(): ?\DateTimeInterface
    {
        return $this->BetPlacedAt;
    }

    public function setBetPlacedAt(\DateTimeInterface $BetPlacedAt): static
    {
        $this->BetPlacedAt = $BetPlacedAt;

        return $this;
    }

    public function getBetStatus(): ?string
    {
        return $this->BetStatus;
    }

    public function setBetStatus(string $BetStatus): static
    {
        $this->BetStatus = $BetStatus;

        return $this;
    }

    public function getUser(): ?User
    {
        return $this->user;
    }

    public function setUser(?User $user): static
    {
        $this->user = $user;

        return $this;
    }

    public function getMatches(): ?Matches
    {
        return $this->matches;
    }

    public function setMatches(?Matches $matches): static
    {
        $this->matches = $matches;

        return $this;
    }

    public function getHomeScore(): ?int
    {
        return $this->homeScore;
    }

    public function setHomeScore(int $homeScore): static
    {
        $this->homeScore = $homeScore;

        return $this;
    }

    public function getAwayScore(): ?int
    {
        return $this->awayScore;
    }

    public function setAwayScore(int $awayScore): static
    {
        $this->awayScore = $awayScore;

        return $this;
    }
}
