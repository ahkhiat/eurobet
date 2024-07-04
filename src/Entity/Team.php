<?php

namespace App\Entity;

use App\Repository\TeamRepository;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Entity(repositoryClass: TeamRepository::class)]
class Team
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Column(length: 255)]
    private ?string $teamName = null;

    #[ORM\Column(length: 255)]
    private ?string $country = null;

    /**
     * @var Collection<int, Matches>
     */
    #[ORM\OneToMany(mappedBy: 'homeTeam', targetEntity: Matches::class)]
    private Collection $homeMatches;

    #[ORM\OneToMany(mappedBy: 'awayTeam', targetEntity: Matches::class)]
    private Collection $awayMatches;

    #[ORM\Column(length: 255)]
    private ?string $illustration = null;

    public function __construct()
    {
        $this->homeMatches = new ArrayCollection();
        $this->awayMatches = new ArrayCollection();
    }

    public function __toString()
    {
        return $this->teamName;
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function getTeamName(): ?string
    {
        return $this->teamName;
    }

    public function setTeamName(string $teamName): static
    {
        $this->teamName = $teamName;

        return $this;
    }

    public function getCountry(): ?string
    {
        return $this->country;
    }

    public function setCountry(string $country): static
    {
        $this->country = $country;

        return $this;
    }

    /**
     * @return Collection<int, Matches>
     */


    public function getHomeMatches(): Collection
    {
        return $this->homeMatches;
    }

    public function getAwayMatches(): Collection
    {
        return $this->awayMatches;
    }

    public function addMatch(Matches $match): static
    {
        if (!$this->matches->contains($match)) {
            $this->matches->add($match);
            $match->setHomeTeam($this);
        }

        return $this;
    }

    public function removeMatch(Matches $match): static
    {
        if ($this->matches->removeElement($match)) {
            // set the owning side to null (unless already changed)
            if ($match->getHomeTeam() === $this) {
                $match->setHomeTeam(null);
            }
        }

        return $this;
    }

    public function getIllustration(): ?string
    {
        return $this->illustration;
    }

    public function setIllustration(string $illustration): static
    {
        $this->illustration = $illustration;

        return $this;
    }
}
