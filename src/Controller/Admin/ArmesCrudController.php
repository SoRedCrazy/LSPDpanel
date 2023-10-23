<?php

namespace App\Controller\Admin;

use App\Entity\Armes;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractCrudController;
use EasyCorp\Bundle\EasyAdminBundle\Field\TextField;
use EasyCorp\Bundle\EasyAdminBundle\Field\AssociationField;
use EasyCorp\Bundle\EasyAdminBundle\Field\ChoiceField;
use EasyCorp\Bundle\EasyAdminBundle\Field\IdField;
use EasyCorp\Bundle\EasyAdminBundle\Config\Action;
use EasyCorp\Bundle\EasyAdminBundle\Config\Actions;
use EasyCorp\Bundle\EasyAdminBundle\Config\{Crud};

class ArmesCrudController extends AbstractCrudController
{
    public static function getEntityFqcn(): string
    {
        return Armes::class;
    }

    public function configureFields(string $pageName): iterable
    {
        return [
            IdField::new('id')->hideOnForm(),
            AssociationField::new('citoyen')->setCrudController(CitoyenCrudController::class),
            TextField::new('Numero_de_serie'),
            TextField::new('nom'),
            ChoiceField::new('type')->setChoices([
                // $value => $badgeStyleName
                'Armes lourds' => 'Armes lourds',
                'pistolé leger' => 'pistolé leger',
                'pistolé de combat' => 'pistolé de combat',
            ]),
        ];
    }
    public function configureActions(Actions $actions): Actions
    {
        return $actions
             ->setPermission(Action::DELETE, 'ROLE_LIEUTENANT')
             ->remove(Crud::PAGE_INDEX, Action::DELETE)
            ->add(Crud::PAGE_INDEX, Action::DETAIL);
    }
}
