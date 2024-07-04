<?php

namespace App\Controller\Admin;

use App\Entity\Team;
use EasyCorp\Bundle\EasyAdminBundle\Config\Crud;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ImageField;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;

class TeamCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Team::class;
    }

    public function configureCrud(Crud $crud): Crud
    {
        return $crud
            ->setEntityLabelInSingular('Equipe')
            ->setEntityLabelInPlural('Equipes')
        ;
    }

    public function configureFields(string $pageName): iterable
    {
        $required = true;

        if ($pageName == 'edit') {
            $required = false;
        }

        return [
            TextField::new('teamName')->setLabel('Nom de l\'équipe')->setHelp('Nom de l\équipe'),
            TextField::new('country')->setLabel('Pays')->setHelp('Pays de l\'équipe'),
            ImageField::new('illustration')
                ->setLabel('Image')
                ->setHelp('Image du produit en 600x600')
                ->setBasePath('/uploads')
                ->setUploadDir('public/uploads')
                ->setUploadedFileNamePattern('[year]-[month]-[day]-[contenthash].[extension]')
                ->setRequired($required)
        ];
    }
}
