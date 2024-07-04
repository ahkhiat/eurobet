<?php

namespace App\Controller\Admin;

use App\Entity\Matches;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Field\DateField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IntegerField;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextEditorField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class MatchesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Matches::class;
    }
    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Match')
            ->setEntityLabelInPlural('Matchs')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
       

        return [
            AssociationField::new('homeTeam', 'Equipe domicile'),
            AssociationField::new('awayTeam', 'Equipe extérieure'),

            DateField::new('matchDate')->setLabel('Date du match')->setHelp('Date du match'),
            IntegerField::new('homeScore')
                ->setLabel('Score équipe domicile')
                ->setHelp('Score équipe domicile')
                ->setValue(0),
            IntegerField::new('awayScore')
                ->setLabel('Score équipe extérieure')
                ->setHelp('Score équipe extérieure')
                ->setValue(0),
            ChoiceField::new('status')->setLabel('Statut du match')->setHelp('Statut du match')->setChoices([
                'A venir' => 'scheduled',
                'Terminé' => 'completed',
                'Reporté' => 'postponed'
            ]),
        ];
    }
    
}
