<?php

namespace App\Twig;

use Twig\Extension\AbstractExtension;
use Twig\TwigFilter;

class AppExtension extends AbstractExtension
{
    public function getFilters(): array
    {
        return [
            new TwigFilter('status', [$this, 'translateStatus']),
        ];
    }

    public function translateStatus(string $status): string
    {
        $translations = [
            'scheduled' => 'A venir',
            'completed' => 'Terminé',
            'postponed' => 'Reporté',
        ];

        return $translations[$status] ?? $status;
    }
}
