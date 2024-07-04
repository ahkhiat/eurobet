<?php

namespace App\Form;

use App\Entity\Bet;
use App\Entity\User;
use App\Entity\Matches;
use Symfony\Component\Form\AbstractType;
use Symfony\Component\Form\FormBuilderInterface;
use Symfony\Bridge\Doctrine\Form\Type\EntityType;
use Symfony\Component\OptionsResolver\OptionsResolver;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\Form\Extension\Core\Type\IntegerType;

class BetType extends AbstractType
{
    public function buildForm(FormBuilderInterface $builder, array $options): void
    {
        $homeTeam = $options['home_team'];
        $awayTeam = $options['away_team'];

        $builder
            ->add('homeScore', IntegerType::class, [
                'label' => 'Score de l\'équipe ' . $homeTeam . ''
            ])
            ->add('awayScore', IntegerType::class, [
                'label' => 'Score de l\'équipe ' . $awayTeam . ''
            ])
            ->add('submit', SubmitType::class, [
                'label' => 'Valider',
                'attr' => [
                    'class' => 'w-100 btn btn-success'
                ]
            ])
            
        ;
    }

    public function configureOptions(OptionsResolver $resolver): void
    {
        $resolver->setDefaults([
            'data_class' => Bet::class,
        ]);
        $resolver->setRequired(['home_team', 'away_team']);

    }
}
